<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Pago;

class PagoController extends Controller
{
    // Muestra la pantalla de selección (PayPal/Stripe)
    public function mostrarCheckout($id_venta)
    {
        $venta = Venta::findOrFail($id_venta);
        return view('tienda.checkout_pago', compact('venta'));
    }

    // Este método lo llamarás cuando el pago sea exitoso
    public function procesarRespuesta(Request $request, $id_venta)
    {
        $venta = Venta::findOrFail($id_venta);

        // 1. Registramos el pago en la tabla 'pagos'
        Pago::create([
            'id_venta' => $venta->id,
            'metodo_pago' => $request->metodo, // 'paypal' o 'stripe'
            'monto' => $venta->total,
            'estado' => 'completado',
            'referencia_pago' => $request->id_transaccion, // ID que da PayPal/Stripe
        ]);

        // 2. Actualizamos el estado de la venta
        $venta->update(['estado' => 'pagado']);

        return redirect()->route('home')->with('success', '¡Gracias por tu compra, el pago fue aprobado!');
    }
}