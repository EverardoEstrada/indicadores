<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use App\Imports\AllImport;
use Excel;

class importerController extends Controller
{

    public function muestraImportacion()
    {
        return view('importar');
    }

    public function importaAlumnos(Request $r)
    {
        Excel::import(new AllImport, request()->file('archivo'));

        return redirect('/')->with('success', 'All good!');
    }
}
