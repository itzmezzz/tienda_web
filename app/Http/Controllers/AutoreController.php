<?php

namespace App\Http\Controllers;
use App\Models\Autore;
use Illuminate\Http\Request;

class AutoreController extends Controller
{
    function guardar(Request $req){
        $autores = new Autore();
        $autores->nombre = $req->nombre;
        $autores->nacionalidad = $req->nacionalidad;
        $autores->save();
        return redirect()->route('autores.lista')
        ->with('success','Autor guardado correctamente');
}
function nuevo(){
    return view('form_aut');
}
function lista(){
    $autores = Autore::all();
    return view('lista_autor', compact('autores'));
}
function eliminar($id){
    $autores = Autore::findOrFail($id);
    $autores->delete();
    return redirect()->route('autores.lista')
    ->with('success','Autor eliminado correctamente');
}
function editar($id){
    $autores = Autore::findOrFail($id);
    return view('aut_aact', compact('autores'));
}

function actualizar(Request $req, $id){
    $autores = Autore::findOrFail($id);
    $autores->nombre = $req->nombre;
    $autores->nacionalidad = $req->nacionalidad;
    $autores->save();
    return redirect()->route('autores.lista')
    ->with('success','Autor actualizado correctamente');
}


}
