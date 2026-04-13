<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    function guardar(Request $req){
        $categoria = new Categoria();
        $categoria->nombre = $req->nombre;
        $categoria->save();
        return redirect()->route('categoria.lista')
        ->with('success','Categoria guardada correctamente');
}
function lista(){
    $categorias = Categoria::all();
    return view('lista_categoria', compact('categorias'));
}
function nuevo(){
    return view('form_cat');
}
function eliminar($id){
    $categoria = Categoria::findOrFail($id);
    $categoria->delete();
    return redirect()->route('categoria.lista')
    ->with('success','Categoria eliminada correctamente');
}
function editar($id){
    $categoria = Categoria::findOrFail($id);
    return view('editar_categoria', compact('categoria'));
}
function actualizar(Request $req, $id){
    $categoria = Categoria::findOrFail($id);
    $categoria->nombre = $req->nombre;
    $categoria->save();
    return redirect()->route('categoria.lista')
    ->with('success','Categoria actualizada correctamente');
}
}

