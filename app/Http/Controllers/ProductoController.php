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

    public function nuevo()
    {
        $categoria = Categoria::all();
        $serie = Serie::all();
        $editorial = Editorial::all();
        $autor = Autore::all();

        return view('form_prod', compact('categoria','serie','editorial','autor'));
    }

    public function guardar(Request $req)
    {
        $producto = new Producto();

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

        if($req->hasFile('imagen')){
            $archivo = $req->file('imagen');
            $nombre = time().'_'.$archivo->getClientOriginalName();
            $archivo->move(public_path('productos'), $nombre);
            $producto->imagen = $nombre;
        }

        $producto->save();

        return redirect()->route('producto.lista')
        ->with('success','Producto guardado correctamente');
    }


    public function lista()
    {
        $productos = Producto::with([
            'autor',
            'serie',
            'categoria',
            'editorial'
        ])->get();

        return view('list_manga', compact('productos'));
    }


    public function liveSearch(Request $req)
    {
        $query = $req->input('q');

        if(!$query){
            return response()->json([]);
        }

        $productos = Producto::where('nombre','like',"$query%")
            ->limit(5)
            ->get(['id','nombre','imagen']);

        return response()->json($productos);
    }


    public function buscar(Request $req)
    {
        $query = $req->input('q');

        $productos = Producto::with([
            'autor',
            'serie',
            'categoria',
            'editorial'
        ])
        ->where(function($q) use ($query){

            $q->where('nombre','like',"%$query%")

            ->orWhereHas('autor',function($q2) use ($query){
                $q2->where('nombre','like',"%$query%");
            })

            ->orWhereHas('serie',function($q2) use ($query){
                $q2->where('nombre','like',"%$query%");
            })

            ->orWhereHas('categoria',function($q2) use ($query){
                $q2->where('nombre','like',"%$query%");
            })

            ->orWhereHas('editorial',function($q2) use ($query){
                $q2->where('nombre','like',"%$query%");
            });

        })->get();

        return view('list_manga', compact('productos','query'));
    }
    public function eliminar($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('producto.lista')
        ->with('success','Producto eliminado correctamente');
    }
    public function editar($id)
    {
        $producto = Producto::findOrFail($id);
        $categoria = Categoria::all();
        $serie = Serie::all();
        $editorial = Editorial::all();
        $autor = Autore::all();

        return view('prod_actualizar', compact('producto','categoria','serie','editorial','autor'));
    }
    public function actualizar(Request $req, $id)
    {
        $producto = Producto::findOrFail($id);

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

        if($req->hasFile('imagen')){
            $archivo = $req->file('imagen');
            $nombre = time().'_'.$archivo->getClientOriginalName();
            $archivo->move(public_path('productos'), $nombre);
            $producto->imagen = $nombre;
        }

        $producto->save();

        return redirect()->route('producto.lista')
        ->with('success','Producto actualizado correctamente');
    }
    public function tienda()
    {
        $productos = Producto::with([
            'autor',
            'serie',
            'categoria',
            'editorial'
        ])->get();

        return view('vista_usuario', compact('productos'));
    }
    

}