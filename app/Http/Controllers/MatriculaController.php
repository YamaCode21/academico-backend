<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MatriculaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
        ]);
        
        $alumno = request()->user();

        if($alumno->role !== 'alumno') {
            return response()->json([
                'message' => 'Solo alumnos pueden matricularse'
            ], 403);
        }

        if ($alumno->cursos()->where('curso_id', $request->curso_id)->exists()) {
            return response()->json([
                'message' => 'Ya estas matriculado en este curso'
            ], 409);
        }

        $alumno->cursos()->attach($request->curso_id);

        return response()->json([
            'message' => 'Matricula registrada correctamente'
        ]);
    }

    public function misCursos()
    {
        return request()->user()->cursos;
    }
}
