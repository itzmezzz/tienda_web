<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductoController extends Controller
{
     function nuevo(){
        $categorias = Categoria::all();
        return view('form_producto', compact('categorias'));
        $series = Serie::all();
        return view('form_producto', compact('series'));
        $editoriales = Editorial::all();
        return view('form_editorial', compact('editoriales'));
    }
    
}
    