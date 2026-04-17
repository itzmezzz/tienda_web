<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Controladores
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AutoreController;
use App\Http\Controllers\SerieController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DashboardController;


Route::get('/', [ProductoController::class, 'tienda']);

//  AUTENTICACIÓN TRADICIONAL Y SOCIAL
Route::view('/registro/form', 'registraruser')->name('register.form');
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/register', [UserController::class, 'register'])->name('register');

// Google Socialite
Route::get('/auth/google', [UserController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/google-callback', [UserController::class, 'handleGoogleCallback']);
Route::post('/logout-google', [UserController::class, 'logoutGoogle'])->name('logout-google');

// --- VERIFICACIÓN DE EMAIL ---
Route::get('/email/verify', function () {
    return view('verificacion');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    $user = $request->user();
    return ($user->rol == 0) ? redirect('/dashboard') : redirect('/tienda');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back();
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// --- CARRITO (Solo usuarios logueados) ---
Route::middleware(['auth'])->group(function () {
    Route::post('/carrito/agregar/{producto}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::get('/carrito', [CarritoController::class, 'mostrar'])->name('carrito.mostrar');
    Route::post('/carrito/eliminar/{producto}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::post('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
    Route::post('/carrito/eliminar-unidad/{producto}', [CarritoController::class, 'eliminarUnidad'])->name('carrito.eliminarUnidad');
});

// --- RUTAS DE CLIENTES (Auth + Email Verificado) ---
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/tienda', [ProductoController::class, 'tienda'])->name('tienda');
    Route::get('/dashboard', function () { return view('dashboard'); });
    Route::get('/perfil', [UserController::class, 'perfil'])->name('perfil');

    // Direcciones
    Route::get('/direcciones', [DireccionController::class, 'index'])->name('direccion.index');
    Route::post('/perfil/direccion', [DireccionController::class, 'guardar'])->name('direccion.guardar');
    Route::get('/direcciones/editar/{id}', [DireccionController::class, 'editar'])->name('direccion.editar');
    Route::put('/direcciones/actualizar/{id}', [DireccionController::class, 'actualizar'])->name('direccion.actualizar');
    Route::get('/direcciones/eliminar/{id}', [DireccionController::class, 'eliminar'])->name('direccion.eliminar');

    // FLUJO DE COMPRA CORREGIDO
    // 1. Mostrar vista de checkout inicial (donde el usuario elige dirección)
    Route::get('/checkout/confirmar', [DireccionController::class, 'mostrarConfirmacion'])->name('checkout.confirmacion');
    
    // 2. Guardar la venta en la DB (Crea el registro de 'Venta' y 'DetalleVenta')
    Route::post('/venta/crear', [VentaController::class, 'store'])->name('venta.store');
    
    // 3. Pasarelas de Pago
    // Esta ruta muestra la vista con los botones de PayPal/Stripe para una venta ya creada
    Route::get('/checkout/pago/{id}', [PagoController::class, 'mostrarCheckout'])->name('checkout.pago');
    
    // Iniciar redirección a Stripe
    Route::get('/pago/stripe/{id}', [PagoController::class, 'iniciarPagoStripe'])->name('pago.stripe');
    
    // RUTA CRÍTICA: Aquí es donde regresan PayPal y Stripe para confirmar el pago y DESCONTAR STOCK
    Route::get('/pago/confirmar/{id}', [PagoController::class, 'procesarRespuesta'])->name('pago.confirmar');

    Route::get('/mis-pedidos', [VentaController::class, 'misCompras'])->name('venta.index');
});

// --- RUTAS DE ADMINISTRACIÓN (Mantenimiento de Catálogo) ---
Route::middleware(['auth'])->group(function () {
    // Categorías
    Route::prefix('categoria')->group(function () {
        Route::get('/form', [CategoriaController::class, 'nuevo'])->name('categoria.nueva');
        Route::post('/guardar', [CategoriaController::class, 'guardar'])->name('categoria.guardar');
        Route::get('/lista', [CategoriaController::class, 'lista'])->name('categoria.lista');
        Route::get('/eliminar/{id}', [CategoriaController::class, 'eliminar'])->name('categoria.eliminar');
        Route::get('/editar/{id}', [CategoriaController::class, 'editar'])->name('categoria.editar');
        Route::put('/actualizar/{id}', [CategoriaController::class, 'actualizar'])->name('categoria.actualizar');
    });

    // Productos / Mangas
    Route::prefix('producto')->group(function () {
        Route::get('/form', [ProductoController::class, 'nuevo'])->name('producto.nuevo');
        Route::post('/guardar', [ProductoController::class, 'guardar'])->name('producto.guardar');
        Route::get('/lista', [ProductoController::class, 'lista'])->name('producto.lista');
        Route::get('/eliminar/{id}', [ProductoController::class, 'eliminar'])->name('producto.eliminar');
        Route::get('/editar/{id}', [ProductoController::class, 'editar'])->name('producto.editar');
        Route::put('/actualizar/{id}', [ProductoController::class, 'actualizar'])->name('producto.actualizar');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/admin/pedidos', [VentaController::class, 'indexAdmin'])->name('admin.pedidos');
        Route::patch('/admin/pedidos/{id}/estado', [VentaController::class, 'actualizarEstado'])->name('admin.pedidos.estado');
    });
    // Búsquedas y Otros
    Route::get('/buscar', [ProductoController::class, 'buscar'])->name('producto.buscar');
    Route::get('/buscarus', [ProductoController::class, 'buscarus'])->name('producto.buscarus');
    Route::get('/producto/live-search', [ProductoController::class, 'liveSearch'])->name('producto.liveSearch');
    Route::get('/catalogo', [ProductoController::class, 'catalogo'])->name('catalogo');
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    


    // Autores, Series, Editoriales (Agrupados para limpieza)
    Route::resource('autores', AutoreController::class)->except(['show', 'create', 'store', 'index', 'destroy', 'edit', 'update']);
    // Nota: He mantenido tus rutas manuales abajo para no romper tu lógica de nombres
    Route::get('/autores/form', [AutoreController::class, 'nuevo'])->name('autores.nuevo');
    Route::post('/autores/guardar', [AutoreController::class, 'guardar'])->name('autores.guardar');
    Route::get('/autores/lista', [AutoreController::class, 'lista'])->name('autores.lista');
    Route::get('/autores/eliminar/{id}', [AutoreController::class, 'eliminar'])->name('autores.eliminar');
    Route::get('/autores/editar/{id}', [AutoreController::class, 'editar'])->name('autores.editar');
    Route::put('/autores/actualizar/{id}', [AutoreController::class, 'actualizar'])->name('autores.actualizar');

    // Series
    Route::get('/series/form', [SerieController::class, 'nuevo'])->name('serie.nuevo');
    Route::post('/series/guardar', [SerieController::class, 'guardar'])->name('serie.guardar');
    Route::get('/series/lista', [SerieController::class, 'lista'])->name('serie.lista');
    Route::get('/series/eliminar/{id}', [SerieController::class, 'eliminar'])->name('serie.eliminar');
    Route::get('/series/editar/{id}', [SerieController::class, 'editar'])->name('serie.editar');
    Route::put('/series/actualizar/{id}', [SerieController::class, 'actualizar'])->name('serie.actualizar');

    // Editoriales
    Route::get('/editorial/form', [EditorialController::class, 'nuevo'])->name('editorial.nuevo');
    Route::post('/editorial/guardar', [EditorialController::class, 'guardar'])->name('editorial.guardar');
    Route::get('/editorial/lista', [EditorialController::class, 'lista'])->name('editorial.lista');
    Route::get('/editorial/eliminar/{id}', [EditorialController::class, 'eliminar'])->name('editorial.eliminar');
    Route::get('/editorial/editar/{id}', [EditorialController::class, 'editar'])->name('editorial.editar');
    Route::put('/editorial/actualizar/{id}', [EditorialController::class, 'actualizar'])->name('editorial.actualizar');
});