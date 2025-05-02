<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PerfilController;

// Ruta principal protegida (home)
Route::get('/home', function () {
    return view('home'); // Asegúrate de tener la vista home.blade.php
})->middleware('auth')->name('home');

// Mostrar formulario de login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Procesar el formulario de login
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

// Cerrar sesión
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Ruta raíz opcional (redirige al login si no está autenticado)
Route::get('/', function () {
    return redirect()->route('login');
});

// Ruta para mostrar el perfil del usuario autenticado
Route::get('/perfil', [PerfilController::class, 'show'])->middleware('auth')->name('perfil');

// Rutas RESTful para usuarios (incluye usuarios.destroy para DELETE)
Route::resource('usuarios', PerfilController::class);

// Ruta para actualizar el perfil del usuario autenticado
Route::put('/usuarios/{id}', [PerfilController::class, 'update'])->name('usuarios.update');


