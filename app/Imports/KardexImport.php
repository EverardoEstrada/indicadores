<?php

namespace App\Imports;

use App\Models\Kardex;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KardexImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Kardex([
            'clave_alumno'=>$row['cve_uaslp_alumno'],
            'clave_materia'=>$row['cve_materia'],
            'nombre_materia'=>$row['nombre_materia'],
            'calificacion'=>$row['calificacion'],
            'fecha_calificacion'=>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['fecha_cal']),
            'tipo_examen'=>$row['tipo_examen'],
            'semestre'=>$row['semestre'],
        ]);
    }
}
