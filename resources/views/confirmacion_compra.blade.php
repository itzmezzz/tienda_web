<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
</head>
<body style="background-color: #0a0a0a; color: #d4d4d8; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding: 20px; margin: 0;">
    <div style="max-width: 600px; mx-auto; background-color: #121212; border: 1px solid #27272a; padding: 40px; border-radius: 8px;">
        
        <h1 style="color: #ea580c; text-transform: uppercase; letter-spacing: 2px; border-bottom: 2px solid #ea580c; pb-10px; margin-top: 0;">
            ¡Gracias por tu compra!
        </h1>
        
        <p style="font-size: 16px; line-height: 1.6;">
            Hola <strong>{{ auth()->user()->name }}</strong>, <br>
            Tu pedido <strong>#{{ $venta->id }}</strong> ha sido procesado con éxito y estamos preparando tus mangas.
        </p>
        
        <table style="width: 100%; border-collapse: collapse; margin-top: 30px;">
            <thead>
                <tr style="border-bottom: 2px solid #ea580c; color: #ffffff;">
                    <th style="text-align: left; padding: 12px; text-transform: uppercase; font-size: 12px;">Manga</th>
                    <th style="text-align: center; padding: 12px; text-transform: uppercase; font-size: 12px;">Cant.</th>
                    <th style="text-align: right; padding: 12px; text-transform: uppercase; font-size: 12px;">Precio</th>
                </tr>
            </thead>
            <tbody>
                @foreach($venta->detalles as $detalle)
                <tr style="border-bottom: 1px solid #27272a;">
                    <td style="padding: 15px 12px; color: #ffffff; font-weight: bold;">
                        {{ $detalle->producto->titulo }}
                    </td>
                    <td style="padding: 15px 12px; text-align: center;">
                        {{ $detalle->cantidad }}
                    </td>
                    <td style="padding: 15px 12px; text-align: right;">
                        ${{ number_format($detalle->precio, 2) }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px; text-align: right;">
            <p style="margin: 0; font-size: 14px; color: #71717a;">Subtotal: ${{ number_format($venta->total, 2) }}</p>
            <h2 style="margin: 5px 0 0 0; color: #ea580c; font-size: 28px;">Total: ${{ number_format($venta->total, 2) }}</h2>
        </div>

        <hr style="border: 0; border-top: 1px solid #27272a; margin: 40px 0;">

        <p style="font-size: 14px; color: #71717a; text-align: center;">
            Si tienes alguna pregunta sobre tu pedido, no dudes en contactarnos a través de nuestro soporte.
        </p>
    </div>
</body>
</html>