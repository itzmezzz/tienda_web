<?php

namespace App\Http\Controllers;
use App\Models\Serie;
use App\Models\Categoria;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    function nuevo(){
        $categorias = Categoria::all();
        return view('form_serie', compact('categorias'));
    }
    function guardar(Request $req){
        $series = new Serie();
        $series->nombre = $req->nombre;
        $series->descripcion = $req->descripcion;
        $series->id_categoria = $req->id_categoria;
        $series->save();
}
function lista(){
    $series = Serie::with('categoria')->get();
    return view('lista_serie', compact('series'));

}}
