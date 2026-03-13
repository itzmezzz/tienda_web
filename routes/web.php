<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AutoreController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('welcome');
});
//categoria
Route::get('/categoria/form', function () {
    return view('form_cat');
});
Route::post('/categoria/guardar',[CategoriaController::class, 'guardar'])->name('categoria.guardar');
Route::get('/categoria/lista',[CategoriaController::class, 'lista'])->name('categoria.lista');

// Login tradicional
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
//google
Route::get('/auth/google', [UserController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/google-callback', [UserController::class, 'handleGoogleCallback']);

//producto
Route::get('/producto/form',[ProductoController::class, 'nuevo'])->name('producto.nuevo');
Route::post('/producto/guardar',[ProductoController::class, 'guardar'])->name('producto.guardar');
Route::get('/producto/lista',[ProductoController::class, 'lista'])->name('producto.lista');
Route::get('/buscar', [ProductoController::class, 'buscar'])->name('producto.buscar');
Route::get('/producto/live-search', [ProductoController::class, 'liveSearch'])->name('producto.liveSearch');

//autores

Route::get('/autores/form',[AutoreController::class, 'nuevo'])->name('autores.nuevo');
Route::post('/autores/guardar',[AutoreController::class, 'guardar'])->name('autores.guardar');
Route::get('/autores/lista',[AutoreController::class, 'lista'])->name('autores.lista');
//series

Route::get('/series/form',[SerieController::class, 'nuevo'])->name('serie.nuevo');
Route::post('/series/guardar',[SerieController::class, 'guardar'])->name('serie.guardar');
Route::get('/series/lista',[SerieController::class, 'lista'])->name('serie.lista');

//editoriales
Route::get('/editorial/form',[EditorialController::class, 'nuevo'])->name('editorial.nuevo');
Route::post('/editorial/guardar',[EditorialController::class, 'guardar'])->name('editorial.guardar');
Route::get('/editorial/lista',[EditorialController::class, 'lista'])->name('editorial.lista');

Route::get('/dashboard', function () 
{     return view('dashboard'); 
});