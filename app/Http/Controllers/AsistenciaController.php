<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Curso;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function store(Request $request, $cursoId)
    {
        $request->validate([
            'fecha' => 'required|date',
            'alumnos' => 'required|array',
            'alumnos.*.id' => 'required|exists:users,id',
            'alumnos.*.presente' => 'required|boolean',
        ]);

        $docente = request()->user();

        // 1. Validar rol
        if ($docente->role !== 'docente') {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        // 2. Validar curso
        $curso = Curso::where('id', $cursoId)
            ->where('docente_id', $docente->id)
            ->firstOrFail();

        foreach ($request->alumnos as $alumno) {

            // 3. Validar matricula
            if (! $curso->alumnos()->where('users.id', $alumno['id'])->exists()) {
                continue;
            }

            Asistencia::updateOrCreate(
                [
                    'alumno_id' => $alumno['id'],
                    'curso_id' => $curso->id,
                    'fecha' => $request->fecha,
                ],
                [
                    'presente' => $alumno['presente']
                ]
            );
        }

        return response()->json([
            'message' => 'Asistencias registradas correctamente'
        ]);
    }
}
