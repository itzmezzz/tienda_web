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

}
