<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    /**
     * Crea la venta y sus detalles en la base de datos
     */
    public function store(Request $request)
    {
        // 1. Validar dirección
        $request->validate([
            'id_direccion' => 'required|exists:direccionusuarios,id'
        ]);

        // 2. Obtener carrito
        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('tienda')->with('error', 'Tu carrito está vacío.');
        }

        // 3. Iniciar Transacción SQL
        DB::beginTransaction();

        try {
            // Calcular total
            $total = collect($carrito)->sum(fn($i) => $i['precio'] * $i['cantidad']);

            // 4. Crear Cabecera de Venta
            $venta = Venta::create([
                'id_usuario'   => Auth::id(),
                'id_direccion' => $request->id_direccion,
                'fecha'        => now(),
                'total'        => $total,
                'estado'       => 'pendiente'
            ]);

            // 5. Crear Detalle de Venta para cada producto
            foreach ($carrito as $item) {
                DetalleVenta::create([
                    'id_venta'        => $venta->id,
                    'id_producto'     => $item['id'],
                    'cantidad'        => $item['cantidad'],
                    'precio_unitario' => $item['precio']
                ]);
            }

            // 6. Confirmar cambios y limpiar sesión
            DB::commit();
            session()->forget('carrito');

            return redirect()->route('checkout.pago', $venta->id)
                             ->with('success', 'Pedido generado con éxito.');

        } catch (\Exception $e) {
            // Si algo falla (ej. error de BD), se deshace todo lo anterior
            DB::rollBack();
            return back()->with('error', 'Error al procesar la compra: ' . $e->getMessage());
        }
    }

    /**
     * Historial de compras para el perfil del usuario
     */
    public function misCompras()
    {
        // Cargamos las ventas con sus detalles y productos relacionados (Eager Loading)
        $ventas = Venta::with(['detalles.producto'])
                       ->where('id_usuario', Auth::id())
                       ->orderBy('fecha', 'desc')
                       ->get();

        return view('perfil.compras', compact('ventas'));
    }
}