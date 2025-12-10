<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProyectosController;
use App\Http\Middleware\MyMiddleware;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [HomeController::class, 'getHome'])
    ->name('home');

// ----------------------------------------
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ----------------------------------------
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ----------------------------------------
Route::prefix('proyectos')->group(function () {
    Route::get('/', [ProyectosController::class, 'getIndex']);
    Route::get('show/{id}', [ProyectosController::class, 'getShow'])->where('id', '[0-9]+');

    // RUTAS PROTEGIDAS CON MIDDLEWARE DE AUTENTICACIÓN -----------------------------------------
    Route::group(['middleware' => 'auth'], function () {
        Route::get('create', [ProyectosController::class, 'getCreate']);

        Route::get('edit/{id}', [ProyectosController::class, 'getEdit'])->where('id', '[0-9]+');
        Route::put('edit/{id}', [ProyectosController::class, 'putEdit'])->where('id', '[0-9]+');

        Route::post('store', [ProyectosController::class, 'store']);
        Route::put('update/{id}', [ProyectosController::class, 'update'])->where('id', '[0-9]+');
    });
});


// ----------------------------------------
Route::get('perfil/{id?}', function ($id = null) {
    if ($id === null)
        return 'Visualizar el currículo propio';
    return 'Visualizar el currículo de ' . $id;
}) -> where('id', '[0-9]+');

// ----------------------------------------
require __DIR__.'/auth.php';
