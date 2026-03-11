<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PistaController;
use App\Http\Controllers\Api\PartidoController;

// Rutas públicas (sin autenticación)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas (requieren autenticación)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});

Route::get('/pistas', [PistaController::class, 'index']); //Listar todas
Route::get('/pistas/{id}', [PistaController::class, 'show']); //Para ver solo una

//Rutas que requieren autenticacion sobre las pistas, ya que algunas acciones requieren autenticacion
Route::middleware('auth:sanctum')->group(function(){
    Route::post('/pistas', [PistaController::class, 'store']); //Para crear una nueva pista
    Route::put('/pistas/{id}', [PistaController::class, 'update']); //Para actualizar una pista
    Route::delete('/pistas/{id}', [PistaController::class, 'destroy']);

    Route::post('/partidos', [PartidoController::class, 'store']);
    Route::put('/partidos/{id}', [PartidoController::class, 'update']);
    Route::delete('/partidos/{id}', [PartidoController::class, 'destroy']);
});

Route::get('/partidos', [PartidoController::class, 'index']);
Route::get('/partidos/{id}', [PartidoController::class, 'show']);

