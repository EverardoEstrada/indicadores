<?php

namespace App\Imports;

use App\Models\Alumno;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AlumnosImport implements ToModel,  WithHeadingRow
{

    public function model(array $row)
    {
        return new Alumno([
            'clave_alumno'=>$row["cve_uaslp_alumno"],
            'clave_larga'=>$row["cve_larga_alumno"],
            'cambio_carera'=>$row["cve_larga_alumno"][8]=='4'? 'VERDADERO' : 'FALSO' ,
            'nombre'=>$row["nombre"],
            'sexo'=>$row["sexo"],
            'generacion'=>$row["generacion"],
            'tutor'=>$row["tutor"],
            'fecha_egreso'=>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["fecha_egreso"]),
            'fecha_pasante'=>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["fecha_pasante"]),
            'fecha_titulacion'=>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["fecha_titulacion"]),
            'situacion'=>$row["situacion"],
            'opcion_titulacion'=>$row["opcion_titulacion"],
            'testimonio_egel'=>$row["testimonio_egel"],
            'materias_reprobadas'=>$row["materias_reprobadas"],
            'dias_titulo'=>$row["situacion"]=='TITULADO'? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["fecha_titulacion"])->diff(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row["fecha_egreso"]))->days : null ,
        ]);
    }
}
