<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use App\Models\Editorial;
use App\Models\Serie;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    function nuevo(){
    $categoria = Categoria::all();
    $serie = Serie::all();
    $editorial = Editorial::all();
    return view('form_prod', compact('categoria','serie','editorial'));
    }

    function guardar(Request $req){
    $producto= new Producto();
    $producto->nombre = $req->nombre;
    $producto->descripcion = $req->descripcion;
    $producto->precio = $req->precio;
    $producto->stock = $req->stock;
    $producto->numero_tomo = $req->numero_tomo;
    $producto->isbn = $req->isbn;
     $producto->id_categoria = $req->id_categoria;
    $producto->id_serie = $req->id_serie;
    $producto->id_editorial = $req->id_editorial;
    // Guardar la imagen si se subió
    // Guardar la imagen directamente en public/productos
    if($req->hasFile('imagen')){
        $archivo = $req->file('imagen');
        $nombre = time().'_'.$archivo->getClientOriginalName(); // Evitar colisiones
        $archivo->move(public_path('productos'), $nombre); // Aquí se guarda la imagen
        $producto->imagen = $nombre; // Guardamos solo el nombre del archivo
    }

    $producto->save();

    return redirect()->route('producto.nuevo')->with('success', 'Producto guardado correctamente');
}
function lista(){
    $productos = Producto::all();
    return view('list_manga', compact('productos'));
}
}
    