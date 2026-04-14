<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DireccionUsuario; // Asegúrate de crear este modelo
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
        ]);

        // Guardamos o actualizamos la dirección del usuario autenticado
        DireccionUsuario::updateOrCreate(
            ['id_usuario' => Auth::id()], // Condición para buscar
            $request->all()              // Datos para insertar/actualizar
        );

        return back()->with('success', 'Dirección actualizada correctamente.');
    }
}
