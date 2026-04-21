<?php

use Illuminate\Support\Facades\Route;

// Customer routes (public)
Route::get('/customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');
Route::post('/customer/check-status', [App\Http\Controllers\CustomerController::class, 'checkStatus'])->name('customer.checkStatus');

// 1. Ruta Raíz: Apunta a HomeController para redirección por rol
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->middleware('auth');

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

// Role dashboards and actions
Route::get('/role-dashboard', [App\Http\Controllers\RoleController::class, 'dashboard'])->name('role.dashboard')->middleware('auth');

// Route worker evidence (nested under orders)
Route::prefix('pedidos/{pedido}/evidencias')->middleware('auth')->group(function () {
    Route::get('/', [App\Http\Controllers\EvidenciaController::class, 'index'])->name('pedidos.evidencias.index');
    Route::get('/create', [App\Http\Controllers\EvidenciaController::class, 'create'])->name('pedidos.evidencias.create');
    Route::post('/', [App\Http\Controllers\EvidenciaController::class, 'store'])->name('pedidos.evidencias.store');
    Route::get('/{evidencia}', [App\Http\Controllers\EvidenciaController::class, 'show'])->name('pedidos.evidencias.show');
    Route::get('/{evidencia}/edit', [App\Http\Controllers\EvidenciaController::class, 'edit'])->name('pedidos.evidencias.edit');
    Route::put('/{evidencia}', [App\Http\Controllers\EvidenciaController::class, 'update'])->name('pedidos.evidencias.update');
    Route::delete('/{evidencia}', [App\Http\Controllers\EvidenciaController::class, 'destroy'])->name('pedidos.evidencias.destroy');
});

// Warehouse/Purchasing material management
Route::resource('materiales', App\Http\Controllers\MaterialController::class)->middleware('auth');
