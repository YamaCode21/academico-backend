<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Curso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatriculaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alumnos = User::where('role', 'alumno')->get();
        $cursos = Curso::all();

        foreach($alumnos as $alumno) {
            foreach($cursos as $curso) {
                $alumno->cursos()->attach($curso->id);
            }
        }
    }
}
