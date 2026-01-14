<?php

namespace Database\Seeders;

use App\Models\Curso;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $docentes = User::where('role', 'docente')->get();

        Curso::create([
            'nombre' => 'Ingles Básico',
            'descripcion' => 'Curso de inglés nivel básico',
            'docente_id' => $docentes[0]->id,
        ]);

        Curso::create([
            'nombre' => 'Inglés Intermedio',
            'descripcion' => 'Curso de inglés nivel intermedio',
            'docente_id' => $docentes[1]->id,
        ]);
    }
}
