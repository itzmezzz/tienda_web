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
}
function lista(){
    $categorias = Categoria::all();
    return view('lista_categoria', compact('categorias'));
}
function nuevo(){
    return view('form_cat');
}
}

