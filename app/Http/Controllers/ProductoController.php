<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use App\Models\Editorial;
use App\Models\Serie;
use App\Models\Producto;
use App\Models\Autore;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    function nuevo(){
    $categoria = Categoria::all();
    $serie = Serie::all();
    $editorial = Editorial::all();
    $autor = Autore::all();
    return view('form_prod', compact('categoria','serie','editorial', 'autor'));
    }

    function guardar(Request $req){
    $producto= new Producto();
    $producto->nombre = $req->nombre;
    $producto->descripcion = $req->descripcion;
    $producto->precio = $req->precio;
    $producto->stock = $req->stock;
    $producto->numero_tomo = $req->numero_tomo;
    $producto->isbn = $req->isbn;
    $producto->id_autor = $req->id_autor;
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

    return redirect()->route('producto.lista')->with('success', 'Producto guardado correctamente');
}
function lista(){
    $productos = Producto::with(['autor', 'serie', 'categoria', 'editorial'])->get();
    return view('list_manga', compact('productos'));
}

public function liveSearch(Request $req)
{
   $query = $req->input('q');

    $query = $request->input('q');

    if (!$query) {
        return response()->json([]);
    }

    $productos = Producto::where('nombre', 'like', "$query%") // empiecen con lo que escriba
        ->limit(5) // limitar resultados
        ->get(['id', 'nombre']); // solo devolver id y nombre

    return response()->json($productos);

}
public function buscar(Request $req)
{
    $query = $req->input('q');

    $productos = Producto::with(['autor','serie','categoria','editorial'])
        ->where('nombre', 'like', "%$query%")
        ->orWhereHas('autor', function($q) use ($query){
            $q->where('nombre', 'like', "%$query%");
        })
        ->orWhereHas('serie', function($q) use ($query){
            $q->where('nombre', 'like', "%$query%");
        })
        ->orWhereHas('categoria', function($q) use ($query){
            $q->where('nombre', 'like', "%$query%");
        })
        ->orWhereHas('editorial', function($q) use ($query){
            $q->where('nombre', 'like', "%$query%");
        })
        ->get();

    return view('list_manga', compact('productos', 'query'));
}
}
    