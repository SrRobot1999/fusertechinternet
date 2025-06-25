<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\ZonaController;
use App\Http\Controllers\ReporteController;

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

// Ruta para mostrar la vista de equipos
Route::get('/equipos', [EquipoController::class, 'show'])->middleware('auth')->name('equipos');
Route::put('/equipos/{id}', [EquipoController::class, 'update'])->name('equipos.update');
Route::delete('/equipos/{id}', [EquipoController::class, 'destroy'])->name('equipos.destroy');
Route::post('/equipos', [EquipoController::class, 'store'])->name('equipos.store');

// Ruta para mostrar la vista de clientes 
Route::get('/clientes', [ClienteController::class, 'show'])->middleware('auth')->name('clientes');
Route::put('/clientes/{id}', [ClienteController::class, 'update'])->name('clientes.update');
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
Route::post('/clientes', [ClienteController::class, 'store'])->name('clientes.store');

// Ruta para mostrar las vista servicios
Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios');
Route::put('/servicios/{id}', [ServicioController::class, 'update'])->name('servicios.update');
Route::delete('/servicios/{id}', [ServicioController::class, 'destroy'])->name('servicios.destroy');
Route::get('/servicios/{id}', [ServicioController::class, 'show'])->name('servicios.show');
Route::post('/servicios', [ServicioController::class, 'store'])->name('servicios.store');
Route::post('/clientes/quick', [\App\Http\Controllers\ClienteController::class, 'quickStore'])->name('clientes.quickStore');

// Ruta para mostrar la vista de pagos
Route::get('/pagos', [PagoController::class, 'index'])->name('pagos');
Route::get('/pagos/siguiente-mes/{clienteId}', [PagoController::class, 'getSiguienteMes']);
Route::put('/pagos/{id}', [PagoController::class, 'update'])->name('pagos.update');
Route::delete('/pagos/{id}', [PagoController::class, 'destroy'])->name('pagos.destroy');
Route::get('/pagos/{id}', [PagoController::class, 'show'])->name('pagos.show');
Route::post('/pagos', [PagoController::class, 'store'])->name('pagos.store');
Route::get('/pagos/get-monto/{clienteId}', [PagoController::class, 'getMontoPorCliente'])->name('pagos.getMontoPorCliente');


// CALENDARIO DE PAGOS
Route::get('/calendario', [CalendarioController::class, 'index'])->name('calendario');


// Ruta para mostrar la vista de usuarios
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios');
Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

// Ruta para crear una nueva zona
Route::post('/zonas', [ZonaController::class, 'store'])->name('zonas.store');

// Ruta para mostrar la vista de bases
Route::get('/bases', [BaseController::class, 'index'])->name('bases');
Route::put('/bases/{id}', [BaseController::class, 'update'])->name('bases.update');
Route::post('/bases', [BaseController::class, 'store'])->name('bases.store');
Route::get('/bases/{id}', [BaseController::class, 'show'])->name('bases.show');
Route::delete('/bases/{id}', [BaseController::class, 'destroy'])->name('bases.destroy');

// Ruta para mostrar la vista de tickets
Route::get('/tickets', [TicketController::class, 'index'])->name('tickets');
Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
Route::put('/tickets/{id}', [TicketController::class, 'update'])->name('tickets.update');
Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');

// Rutas para reportes
Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes');
Route::get('/reportes/exportar', [ReporteController::class, 'exportar'])->name('reportes.exportar');



// Rutas para mostrar pdf de tickets
Route::get('/tickets/{id}', [TicketController::class, 'pdf'])->name('tickets.pdf');

// Mostrar notoficaciones
Route::get('/showNotifications', [NotificationsController::class, 'showNotification'])->name('notifications.showNotifications');