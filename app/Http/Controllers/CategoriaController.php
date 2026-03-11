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
}

