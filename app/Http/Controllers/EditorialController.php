<?php

namespace App\Http\Controllers;
use App\Models\Editorial;
use Illuminate\Http\Request;

class EditorialController extends Controller
{

    public function nuevo(){
        return view('form_editorial');
    }
    function guardar(Request $req){
        $editorial = new Editorial();
        $editorial->nombre = $req->nombre;
        $editorial->save();
        return redirect()->route('editorial.lista');
}
function lista(){
    $editoriales = Editorial::all();
    return view('lista_editorial', compact('editoriales'));
}
function eliminar($id){
    $editorial = Editorial::findOrFail($id);
    $editorial->delete();
    return redirect()->route('editorial.lista');
}
function editar($id){
    $editorial = Editorial::findOrFail($id);
    return view('editar_editorial', compact('editorial'));
    }
function actualizar(Request $req, $id){
    $editorial = Editorial::findOrFail($id);
    $editorial->nombre = $req->nombre;
    $editorial->save();
    return redirect()->route('editorial.lista');
}
}