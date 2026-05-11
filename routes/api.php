<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PedidoApiController;
use App\Http\Controllers\Api\ClienteApiController;
use App\Http\Controllers\Api\MaterialApiController;
use App\Http\Controllers\Api\AuthApiController;

// Public routes
Route::post('/login', [AuthApiController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('pedidos', PedidoApiController::class);
    Route::apiResource('clientes', ClienteApiController::class);
    Route::apiResource('materiales', MaterialApiController::class);
});
