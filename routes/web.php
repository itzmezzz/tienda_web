<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AutoreController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\EditorialController;
use App\Models\user;

Route::get('/', function () {
    return view('welcome');
});
//categoria
Route::get('/categoria/form', function () {
    return view('form_cat');
});
Route::post('/categoria/guardar',[CategoriaController::class, 'guardar'])->name('categoria.guardar');

//google
Route::get('/google-login', function(){
    return Socialite::driver('google')->redirect();
})->name('login.google');

//producto
Route::get('/producto/form', function () {
    return view('form_prod');
});
Route::post('/producto/guardar',[ProductoController::class, 'guardar'])->name('producto.guardar');
//autores
Route::get('/autores/form', function () {
    return view('form_aut');
});
Route::post('/autores/guardar',[AutoreController::class, 'guardar'])->name('autores.guardar');
//series
Route::get('/series/form',[SerieController::class, 'nuevo'])->name('serie.nuevo');
Route::post('/series/guardar',[SerieController::class, 'guardar'])->name('serie.guardar');

//editoriales
Route::get('/editorial/form', function () {
    return view('form_editorial');
});
Route::post('/editorial/guardar',[EditorialController::class, 'guardar'])->name('editorial.guardar');