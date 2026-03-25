<?php

use Illuminate\Support\Facades\Route;

// Customer routes (public)
Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');
Route::post('/customer/check-status', [App\Http\Controllers\CustomerController::class, 'checkStatus'])->name('customer.checkStatus');

// 1. Ruta Raíz: Apunta a nuestra nueva interfaz de CoreUI
Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

// 2. Rutas del andamiaje de Autenticación (Login, Registro, Recuperación)
Auth::routes(); // Enable public registration for basic customer accounts
Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
// Register route now available for basic customer signup

// 3. Ruta de inicio post-autenticación
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 4. Resource Routes for Users
Route::resource('users', App\Http\Controllers\UserController::class)->middleware('auth');

// Orders
Route::resource('pedidos', App\Http\Controllers\PedidoController::class)->middleware('auth');
Route::get('pedidos-deleted', [App\Http\Controllers\PedidoController::class, 'deleted'])->name('pedidos.deleted')->middleware('auth');
Route::patch('pedidos/{id}/restore', [App\Http\Controllers\PedidoController::class, 'restore'])->name('pedidos.restore')->middleware('auth');

// Clients
Route::resource('clientes', App\Http\Controllers\ClienteController::class)->middleware('auth');
