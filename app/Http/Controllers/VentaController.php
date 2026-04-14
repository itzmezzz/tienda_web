<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\DetalleCarrito; // Si decides mover los detalles a la venta
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    /**
     * Crea la venta a partir del carrito actual
     */
    public function store(Request $request)
    {
        // 1. Validar que se haya seleccionado una dirección
        $request->validate([
            'id_direccion' => 'required|exists:direccionusuarios,id'
        ]);

        // 2. Obtener el carrito de la sesión
        $carrito = session()->get('carrito', []);

        if (empty($carrito)) {
            return back()->with('error', 'Tu carrito está vacío.');
        }

        // 3. Calcular el total acumulado
        $total = collect($carrito)->sum(function($item) {
            return $item['precio'] * $item['cantidad'];
        });

        // 4. Crear el registro de la Venta
        $venta = Venta::create([
            'id_usuario'   => Auth::id(),
            'id_direccion' => $request->id_direccion,
            'fecha'        => now(),
            'total'        => $total,
            'estado'       => 'pendiente' // Estado inicial según tu migración
        ]);

        // NOTA: Aquí es donde normalmente moverías los productos del carrito 
        // a una tabla llamada 'detalle_ventas' para que queden guardados permanentemente.

        // 5. Vaciar el carrito de la sesión
        session()->forget('carrito');

        // 6. Redirigir al controlador de pagos pasando el ID de la venta
        return redirect()->route('checkout.pago', $venta->id)
                         ->with('success', 'Pedido generado. Por favor, selecciona tu método de pago.');
    }

    /**
     * Muestra el historial de compras del usuario logueado
     */
    public function misCompras()
    {
        $ventas = Venta::where('id_usuario', Auth::id())
                       ->orderBy('fecha', 'desc')
                       ->get();

        return view('perfil.compras', compact('ventas'));
    }
}