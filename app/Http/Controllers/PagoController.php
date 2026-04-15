<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Pago;
use App\Models\Carrito;
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\Log;  
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class PagoController extends Controller
{
    public function mostrarCheckout($id_venta)
    {
        $venta = Venta::findOrFail($id_venta);
        
        $direcciones = \App\Models\DireccionUsuario::where('id_usuario', auth()->id())->get();
        $total = $venta->total;

        return view('checkout', [
            'venta' => $venta,
            'direcciones' => $direcciones,
            'total' => $total,
            'stripeKey' => env('STRIPE_KEY')
        ]);
    }

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
                    'unit_amount' => $venta->total * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('pago.confirmar', $venta->id) . '?metodo=stripe&id_transaccion={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('checkout.confirmacion'),
        ]);

        return redirect($session->url);
    }

    public function procesarRespuesta(Request $request, $id_venta)
    {
        // Cargamos la venta con sus detalles y el manga relacionado
        $venta = Venta::with('detalles.producto')->findOrFail($id_venta);

        if ($venta->estado === 'pagado') {
            return redirect()->route('tienda')->with('success', 'Este pedido ya fue pagado.');
        }

        // 1. Registrar el pago
        Pago::create([
            'id_venta' => $venta->id,
            'metodo_pago' => $request->query('metodo', 'desconocido'), 
            'monto' => $venta->total,
            'estado' => 'completado',
            'referencia_pago' => $request->query('id_transaccion', 'N/A'),
        ]);

        // 2. Actualizar estado de la venta
        $venta->update(['estado' => 'pagado']);

        // 3. VACÍAR EL CARRITO del usuario
        // Usamos el modelo importado arriba
        $carrito = Carrito::where('id_usuario', auth()->id())->first();

        if ($carrito) {
    // Borramos primero los productos asociados
         $carrito->detalles()->delete(); 
    // Luego borramos el carrito
             $carrito->delete();
        }

        // 4. ENVIAR CORREO de confirmación
        try {
            Mail::to(auth()->user()->email)->send(new \App\Mail\ConfirmacionCompra($venta));
        } catch (\Exception $e) {
            Log::error("Error en correo Manga House: " . $e->getMessage());
        }

        // 5. Redirección final con mensaje flash
        return redirect()->route('tienda')->with('success', '¡Compra exitosa! Revisa tu correo para ver los detalles de tus mangas.');
    }
}