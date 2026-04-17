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
        return redirect()->route('serie.lista');
}
function lista(){
    $series = Serie::with('categoria')->get();
    return view('lista_serie', compact('series'));
}
function eliminar($id){
    $serie = Serie::findOrFail($id);
    $serie->delete();
    return redirect()->route('serie.lista');
}
function editar($id){
    $serie = Serie::findOrFail($id);
    $categorias = Categoria::all();
    return view('serie_act', compact('serie','categorias'));
}
function actualizar(Request $req, $id){
    $serie = Serie::findOrFail($id);
    $serie->nombre = $req->nombre;
    $serie->descripcion = $req->descripcion;
    $serie->id_categoria = $req->id_categoria;
    $serie->save();
    return redirect()->route('serie.lista');
}

}
