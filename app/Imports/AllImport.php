<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AllImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new AlumnosImport(),
            new KardexImport()
        ];
    }
}
