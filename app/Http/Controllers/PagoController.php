<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Pago;
use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\DB; 
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class PagoController extends Controller
{
    public function mostrarCheckout($id_venta)
    {
        $venta = Venta::findOrFail($id_venta);
        
        // Usamos el modelo de dirección del usuario
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
        // 1. Cargar la venta con sus detalles y productos
        $venta = Venta::with('detalles.producto')->findOrFail($id_venta);

        // Si ya está pagada, evitamos duplicar procesos
        if ($venta->estado === 'pagado') {
            return redirect()->route('tienda')->with('success', 'Este pedido ya fue pagado.');
        }

        try {
            // INICIO DE TRANSACCIÓN ATÓMICA
            DB::transaction(function () use ($venta, $request) {
                
                // A. ACTUALIZAR STOCK DE MANGAS
                foreach ($venta->detalles as $detalle) {
                    $producto = $detalle->producto;

                    if (!$producto) {
                        throw new \Exception("Producto no encontrado.");
                    }

                    if ($producto->stock < $detalle->cantidad) {
                        throw new \Exception("Stock insuficiente para: " . $producto->nombre);
                    }

                    // Decremento directo en DB para evitar condiciones de carrera
                    $producto->decrement('stock', $detalle->cantidad);
                }

                // B. REGISTRAR EL PAGO
                Pago::create([
                    'id_venta' => $venta->id,
                    'metodo_pago' => $request->query('metodo', 'desconocido'), 
                    'monto' => $venta->total,
                    'estado' => 'completado',
                    'referencia_pago' => $request->query('id_transaccion', 'N/A'),
                ]);

                // C. ACTUALIZAR ESTADO DE VENTA
                $venta->update(['estado' => 'pagado']);

                // D. VACIAR CARRITO (Solución robusta)
                $idUsuario = auth()->id();
                $carrito = Carrito::where('id_usuario', $idUsuario)->first();

                if ($carrito) {
                    // Borramos detalles primero por la llave foránea
                    DB::table('detalle_carritos')->where('id_carrito', $carrito->id)->delete();
                    // Borramos el carrito principal
                    $carrito->delete();
                }
            });

            // 2. ENVÍO DE CORREO (Fuera de la transacción por rendimiento)
            try {
                Mail::to(auth()->user()->email)->send(new \App\Mail\ConfirmacionCompra($venta));
            } catch (\Exception $e) {
                Log::error("Error enviando correo MangaHouse: " . $e->getMessage());
            }

            return redirect()->route('tienda')->with('success', '¡Compra exitosa! Tu pedido está en camino.');

        } catch (\Exception $e) {
            Log::error("Fallo crítico en PagoController: " . $e->getMessage());
            return redirect()->route('tienda')->with('error', 'Hubo un problema: ' . $e->getMessage());
        }
    }
}