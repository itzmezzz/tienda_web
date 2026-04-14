<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Carrito;
use App\Models\DetalleCarrito; 
use Illuminate\Support\Facades\Auth;

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
        $producto = Producto::findOrFail($productoId);
        $carrito = session()->get('carrito', []);

        // --- PASO 1: SESIÓN ---
        if(isset($carrito[$productoId])){
            $carrito[$productoId]['cantidad']++;
        } else {
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

        // --- PASO 2: BASE DE DATOS ---
        if (Auth::check()) {
            $carritoBD = Carrito::firstOrCreate(
                ['id_usuario' => Auth::id(), 'estado' => 'activo']
            );

            $detalle = DetalleCarrito::where('id_carrito', $carritoBD->id)
                                     ->where('id_producto', $productoId)
                                     ->first();

            if ($detalle) {
                $detalle->increment('cantidad');
            } else {
                DetalleCarrito::create([
                    'id_carrito' => $carritoBD->id,
                    'id_producto' => $productoId,
                    'cantidad' => 1,
                    'precio' => $producto->precio // ANTES DECÍA 'precio_unitario'
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'carrito' => array_values($carrito) 
        ]);
    }

    public function eliminar($productoId)
    {
        $carrito = session()->get('carrito', []);
        unset($carrito[$productoId]);
        session()->put('carrito', $carrito);

        if (Auth::check()) {
            $carritoBD = Carrito::where('id_usuario', Auth::id())->where('estado', 'activo')->first();
            if ($carritoBD) {
                DetalleCarrito::where('id_carrito', $carritoBD->id)
                              ->where('id_producto', $productoId)
                              ->delete();
            }
        }

        return response()->json(['success' => true, 'carrito' => array_values($carrito)]);
    }

    public function eliminarUnidad($productoId)
    {
        $carrito = session()->get('carrito', []);

        if(isset($carrito[$productoId])){
            if($carrito[$productoId]['cantidad'] > 1){
                $carrito[$productoId]['cantidad']--;
                if (Auth::check()) {
                    $this->actualizarCantidadBD($productoId, -1);
                }
            } else {
                unset($carrito[$productoId]);
                if (Auth::check()) {
                    $this->eliminarDeBD($productoId);
                }
            }
        }

        session()->put('carrito', $carrito);
        return response()->json(['success' => true, 'carrito' => array_values($carrito)]);
    }

    public function vaciar()
    {
        session()->forget('carrito');
        if (Auth::check()) {
            $carritoBD = Carrito::where('id_usuario', Auth::id())->where('estado', 'activo')->first();
            if ($carritoBD) { $carritoBD->detalles()->delete(); }
        }
        return response()->json(['success' => true, 'carrito' => []]);
    }

    // Métodos de ayuda para no repetir código
    private function eliminarDeBD($productoId) {
        $carritoBD = Carrito::where('id_usuario', Auth::id())->where('estado', 'activo')->first();
        if ($carritoBD) {
            DetalleCarrito::where('id_carrito', $carritoBD->id)->where('id_producto', $productoId)->delete();
        }
    }

    private function actualizarCantidadBD($productoId, $valor) {
        $carritoBD = Carrito::where('id_usuario', Auth::id())->where('estado', 'activo')->first();
        if ($carritoBD) {
            $detalle = DetalleCarrito::where('id_carrito', $carritoBD->id)->where('id_producto', $productoId)->first();
            if ($detalle) { $detalle->increment('cantidad', $valor); }
        }
    }
}