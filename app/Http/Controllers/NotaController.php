<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Nota;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    public function store(Request $request, $cursoId)
    {
        $request->validate([
            'alumnos' => 'required|array',
            'alumnos.*.id' => 'required|exists:users,id',
            'alumnos.*.nota' => 'required|numeric|min:0|max:20',
        ]);

        $docente = request()->user();

        if ($docente->role !== 'docente') {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $curso = Curso::where('id', $cursoId)
            ->where('docente_id', $docente->id)
            ->firstOrFail();

        foreach ($request->alumnos as $alumno) {
            if (! $curso->alumnos()->where('users.id', $alumno['id'])->exists()) {
                continue;
            }

            Nota::updateOrCreate(
                [
                    'alumno_id' => $alumno['id'],
                    'curso_id' => $curso->id,
                ],
                [
                    'nota' => $alumno['nota']
                ]
            );
        }

        return response()->json([
            'message' => 'Notas registradas correctamente'
        ]);
    }
}
