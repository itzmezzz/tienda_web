<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Carrito;

class CarritoController extends Controller
{
   public function mostrar()
{
    return response()->json([
        'carrito' => session()->get('carrito', [])
    ]);
}

public function agregar($productoId)
{
    $carrito = session()->get('carrito', []);

    if(isset($carrito[$productoId])){
        $carrito[$productoId]['cantidad']++;
    } else {
        $producto = Producto::findOrFail($productoId);

        $carrito[$productoId] = [
            'id' => $producto->id,
            'nombre' => $producto->nombre,
            'precio' => $producto->precio,
            'imagen' => asset('productos/' . $producto->imagen),
            'numero_tomo' => $producto->numero_tomo,
            'cantidad' => 1
        ];
    }

    session()->put('carrito', $carrito);

    return response()->json([
        'success' => true,
        'carrito' => $carrito
    ]);
}

public function eliminar($productoId)
{
    $carrito = session()->get('carrito', []);
    unset($carrito[$productoId]);

    session()->put('carrito', $carrito);

    return response()->json(['success' => true, 'carrito' => $carrito]);
}

public function eliminarUnidad($productoId)
{
    $carrito = session()->get('carrito', []);

    if(isset($carrito[$productoId])){
        if($carrito[$productoId]['cantidad'] > 1){
            $carrito[$productoId]['cantidad']--;
        } else {
            unset($carrito[$productoId]);
        }
    }

    session()->put('carrito', $carrito);

    return response()->json(['success' => true, 'carrito' => $carrito]);
}

public function vaciar()
{
    session()->forget('carrito');
    return response()->json(['success' => true]);
}
}