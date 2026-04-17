<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\DetalleVenta; // Asegúrate de tener este modelo
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_direccion' => 'required',
            'metodo' => 'required' 
        ]);

        $carrito = session()->get('carrito', []);
        
        if (empty($carrito)) {
            return redirect()->route('tienda')->with('error', 'Tu carrito está vacío.');
        }

        $total = collect($carrito)->sum(fn($item) => $item['precio'] * $item['cantidad']);

        // Usamos una transacción para asegurar que si algo falla, no se cree la venta vacía
        return DB::transaction(function () use ($request, $carrito, $total) {
            
            // 1. Crear la cabecera de la Venta
            $venta = Venta::create([
                'id_usuario' => Auth::id(),
                'id_direccion' => $request->id_direccion,
                'total' => $total,
                'estado' => 'pendiente',
                'fecha' => now(),
            ]);

            // 2. Guardar cada producto del carrito en DetalleVenta
           foreach ($carrito as $id_producto => $item) {
             DetalleVenta::create([
            'id_venta'    => $venta->id,
            'id_producto' => $id_producto,
            'cantidad'    => $item['cantidad'],
             'precio'      => $item['precio'], 
            ]);
            }

            
            //session()->forget('carrito');

            // 4. Redirección según el método elegido
            if ($request->metodo == 'stripe') {
                return redirect()->route('pago.stripe', $venta->id);
            }

            return redirect()->route('checkout.pago', $venta->id);
        });
    }

    public function misCompras()
    {
        // Eager loading para evitar el problema de consultas N+1
        $ventas = Venta::with(['detalles.producto'])
                        ->where('id_usuario', Auth::id())
                        ->orderBy('fecha', 'desc')
                        ->get();

        return view('perfil', compact('ventas'));
    }
    // Añadir al VentaController.php

public function indexAdmin()
{
    // Eager loading de usuario y detalles con sus productos para el Admin
    $pedidos = Venta::with(['usuario', 'detalles.producto'])
                    ->orderBy('fecha', 'desc')
                    ->paginate(15);

    return view('pedidos', compact('pedidos'));
}

public function actualizarEstado(Request $request, $id)
{
    $venta = Venta::findOrFail($id);
    $venta->estado = $request->estado;
    $venta->save();

    return back()->with('success', 'ESTADO DEL PEDIDO #' . $id . ' ACTUALIZADO');
}

}