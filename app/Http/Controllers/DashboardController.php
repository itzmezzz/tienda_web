<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Venta;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
  public function index()
{
    // --- KPIs ---
    $totalProductos = \App\Models\Producto::count();
    $totalStock = \App\Models\Producto::sum('stock');
    $ventasHoy = \App\Models\Venta::whereDate('created_at', \Carbon\Carbon::today())->sum('total');
    $pedidosPendientes = \App\Models\Venta::where('estado', 'pendiente')->count();
    $totalClientes = \App\Models\User::where('rol', 'cliente')->count();
    $stockBajo = \App\Models\Producto::where('stock', '<', 5)->count();
    $totalCategorias = \App\Models\Categoria::count(); 

    // --- TABLAS ---
    $pedidosRecientes = \App\Models\Venta::with('usuario')->latest()->take(5)->get();
    
    // Esta es para la tabla de "Últimas Entradas"
    $recientes = \App\Models\Producto::with(['categoria', 'editorial'])->latest()->take(5)->get();

    // --- LATERAL (Aquí cambié el nombre para que coincida con tu vista) ---
    $topMangas = \App\Models\Producto::with(['autor', 'categoria'])
        ->orderBy('stock', 'asc') 
        ->take(4)
        ->get();

    // --- ESTADÍSTICAS ---
    $categoriasStats = \App\Models\Categoria::withCount('productos')->get();

    // --- ENVÍO A VISTA ---
    return view('dashboard', compact(
        'totalProductos',
        'totalStock',
        'ventasHoy', 
        'pedidosPendientes', 
        'totalClientes', 
        'stockBajo',
        'totalCategorias',
        'pedidosRecientes',
        'recientes',
        'topMangas', // <--- Ahora se llama igual que en el @foreach de tu vista
        'categoriasStats'
    ));
}
}