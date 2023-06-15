<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kardex;
use Illuminate\Support\Facades\DB;

class Alumno extends Model
{
    use HasFactory;
    protected $table='alumnos';

     protected $fillable = [
        'clave_alumno',
        'clave_larga',
        'cambio_carera',
        'nombre',
        'sexo',
        'generacion',
        'tutor',
        'fecha_egreso',
        'fecha_pasante',
        'fecha_titulacion',
        'situacion',
        'opcion_titulacion',
        'testimonio_egel',
        'materias_reprobadas',
        'dias_titulo',
    ];

    function NumSemestresInscritos() {
        $nsemestres=DB::table('kardex')->where('clave_alumno',$this->clave_alumno)->distinct('semestre')->count('semestre');
        return $nsemestres;
    }

    function SemestresInscritos() {
        $nsemestres=DB::table('kardex')->select('semestre')->where('clave_alumno',$this->clave_alumno)->distinct('semestre')->get();

        return $nsemestres;

    }
}
