<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@academico.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Docente
        User::create([
            'name' => 'Juan Docente',
            'email' => 'docente1@academico.com',
            'password' => Hash::make('password'),
            'role' => 'docente',
        ]);

        User::create([
            'name' => 'Maria Docente',
            'email' => 'docente2@academico.com',
            'password' => Hash::make('password'),
            'role' => 'docente',
        ]);

        // Alummnos
        for($i = 1;$i <= 6; $i++) {
            User::create([
                'name' => "Alumno $i",
                'email' => "alumno$i@academico.com",
                'password' => Hash::make('password'),
                'role' => 'alumno',
            ]);
        }
    }
}
