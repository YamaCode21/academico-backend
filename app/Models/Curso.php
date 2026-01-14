<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'docente_id',
    ];

    public function docente()
    {
        return $this->belongsTo(User::class, 'docente_id');
    }

    public function alumnos()
    {
        return $this->belongsToMany(User::class, 'matriculas', 'curso_id', 'alumno_id')
            ->withTimestamps();
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }
}
