<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $fillable = [
        'alumno_id',
        'curso_id',
        'fecha',
        'estado',
        'observaciones',
    ];
}
