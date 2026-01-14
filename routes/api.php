<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CursoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\NotaController;

Route::middleware('auth:sanctum')->get('/users', [AuthController::class, 'index']);
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

Route::middleware(['auth:sanctum', 'role:docente'])->group(function () {
    Route::post('/cursos/{curso}/asistencias', [AsistenciaController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'role:docente'])->group(function () {
    Route::post('/cursos/{curso}/notas', [NotaController::class, 'store']);
});