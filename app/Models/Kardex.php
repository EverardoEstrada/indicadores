<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    use HasFactory;

    protected $table="kardex";
    protected $fillable=[
        'clave_alumno',
        'clave_materia',
        'nombre_materia',
        'calificacion',
        'fecha_calificacion',
        'tipo_examen',
        'semestre',
    ];
}
