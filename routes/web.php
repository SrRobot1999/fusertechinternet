<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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