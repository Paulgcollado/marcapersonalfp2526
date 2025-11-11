<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// ----------------------------------------
Route::get('login', function () {
    return "Login usuario";
});
Route::get('logout', function () {
    return "Logout usuario";
});


// ----------------------------------------
Route::prefix('proyectos')->group(function () {
    Route::get('/', function () {
        return 'Listado proyectos';
    });

    Route::get('create', function () {
        return 'Añadir proyecto';
    });

    Route::get('/show/{id}', function ($id) {
        return 'Vista detalle proyecto ' . $id;
    }) -> where('id', '[0-9]+');

    Route::get('/edit/{id}', function ($id) {
        return 'Modificar proyecto ' . $id;
    }) -> where('id', '[0-9]+');
});


// ----------------------------------------
Route::get('perfil/{id?}', function ($id = null) {
    if ($id === null)
        return 'Visualizar el currículo propio';
    return 'Visualizar el currículo de ' . $id;
}) -> where('id', '[0-9]+');


Route::get('/users', function () {
    return view('users.listaUsuarios', [
        'users' => [
            ['id' => 1, 'name' => 'Alice'],
            ['id' => 2, 'name' => 'Luis'],
            ['id' => 3, 'name' => 'Maurice'],
            ['id' => 4, 'name' => 'Matt']
        ]
    ]);
});

