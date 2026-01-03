<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CursoController;
use App\Http\Controllers\MatriculaController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/me', function (Request $request) {
        return $request->user();
    });
});


Route::middleware(['auth:sanctum', 'role:admin']) -> group(function () {
    Route::get('/admin/dashboard', function () {
        return response()->json([
            'message' => 'Bienvenido administrador'
        ]);
    });

    Route::apiResource('cursos', CursoController::class);
});

Route::middleware(['auth:sanctum', 'role:alumno']) ->group(function () {
    Route::post('/matriculas', [MatriculaController::class, 'store']);
    Route::get('/mis-cursos', [MatriculaController::class, 'misCursos']);
});