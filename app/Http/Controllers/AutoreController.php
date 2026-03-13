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
}
function nuevo(){
    return view('form_aut');
}
}
