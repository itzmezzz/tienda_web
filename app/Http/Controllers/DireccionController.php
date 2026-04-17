<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DireccionUsuario; 
use Illuminate\Support\Facades\Auth;

class DireccionController extends Controller
{
    public function guardar(Request $request)
    {
        $request->validate([
            'calle' => 'required|string|max:150',
            'ciudad' => 'required|string|max:100',
            'estado' => 'required|string|max:100',
            'codigo_postal' => 'required|string|max:20',
            'pais' => 'required|string|max:100', // Agregado ya que está en tu tabla
        ]);

        // Usamos updateOrCreate para que el usuario solo tenga una dirección principal
        DireccionUsuario::updateOrCreate(
            ['id_usuario' => Auth::id()], 
            [
                'calle' => $request->calle,
                'ciudad' => $request->ciudad,
                'estado' => $request->estado,
                'codigo_postal' => $request->codigo_postal,
                'pais' => $request->pais,
                'referencia' => $request->referencia,
            ]
            );

    DireccionUsuario::updateOrCreate(
        ['id_usuario' => Auth::id()], 
        [
            'calle' => $request->calle,
            'ciudad' => $request->ciudad,
            'estado' => $request->estado,
            'codigo_postal' => $request->codigo_postal,
            'pais' => $request->pais,
            'referencia' => $request->referencia,
        ]
        );

        return redirect()->route('checkout.confirmacion')->with('success', 'Dirección guardada correctamente.');
    }

    // NUEVO MÉTODO: Para cargar la vista de confirmación con datos
    public function mostrarConfirmacion()
    {
        $direcciones = DireccionUsuario::where('id_usuario', Auth::id())->get();
        $carrito = session()->get('carrito', []);

        $total = collect($carrito)->sum(function($item) {
            return $item['precio'] * $item['cantidad'];
        });

        return view('checkout', compact('direcciones', 'total'));
    }
    public function index()
{
    // Buscamos si el usuario ya tiene una dirección
    $direccion = DireccionUsuario::where('id_usuario', Auth::id())->first();
    
    // Retornamos la vista donde estará el formulario
    return view('direcciones', compact('direccion'));
}
public function editar($id)
{
    $direccion = DireccionUsuario::where('id', $id)
                                ->where('id_usuario', auth()->id()) // Seguridad: solo sus propias direcciones
                                ->firstOrFail();
    return view('dire_act', compact('direccion'));
}

public function actualizar(Request $request, $id)
{
    $direccion = DireccionUsuario::where('id', $id)
                                ->where('id_usuario', auth()->id())
                                ->firstOrFail();

    $direccion->update($request->all());

    return redirect()->route('direccion.index')->with('success', 'Dirección actualizada');
}

public function eliminar($id)
{
    $direccion = DireccionUsuario::where('id', $id)
                                ->where('id_usuario', auth()->id())
                                ->firstOrFail();
    $direccion->delete();

    return redirect()->route('direccion.index')->with('success', 'Dirección eliminada');
}
}