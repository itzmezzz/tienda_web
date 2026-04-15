<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Pago;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class PagoController extends Controller
{
   public function mostrarCheckout($id_venta)
{
    $venta = Venta::findOrFail($id_venta);
    
    // Mandamos todo lo que la vista 'checkout' espera normalmente
    $direcciones = \App\Models\DireccionUsuario::where('id_usuario', auth()->id())->get();
    $total = $venta->total;

    return view('checkout', [
        'venta' => $venta, // Variable clave para saber que estamos en modo "pago"
        'direcciones' => $direcciones,
        'total' => $total,
        'stripeKey' => env('STRIPE_KEY')
    ]);
}

    // Método para crear sesión de Stripe
    public function iniciarPagoStripe($id_venta)
    {
        $venta = Venta::findOrFail($id_venta);
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'mxn',
                    'product_data' => ['name' => 'MangaHouse - Pedido #' . $venta->id],
                    'unit_amount' => $venta->total * 100, // Centavos
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('pago.confirmar', $venta->id) . '?metodo=stripe&id_transaccion={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.confirmacion'),
        ]);

        return redirect($session->url);
    }

    // Este es tu método para procesar la respuesta de pago (puede ser llamado desde PayPal o Stripe)
   public function procesarRespuesta(Request $request, $id_venta)
{
    $venta = Venta::findOrFail($id_venta);

    if ($venta->estado === 'pagado') {
        return redirect()->route('tienda')->with('success', 'Este pedido ya fue pagado.');
    }

    Pago::create([
        'id_venta' => $venta->id,
        // Usamos query() para leer lo que viene después del '?' en la URL
        'metodo_pago' => $request->query('metodo', 'desconocido'), 
        'monto' => $venta->total,
        'estado' => 'completado',
        'referencia_pago' => $request->query('id_transaccion', 'N/A'),
    ]);

    $venta->update(['estado' => 'pagado']);

    return redirect()->route('tienda')->with('success', '¡Gracias por tu compra!');
}
}