<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Alumno;
use App\Models\Kardex;

class AlumnosController extends Controller
{
    function index(Request $request)
    {
        $generaciones=DB::table('alumnos')->select('generacion as año')->distinct()->get();
        if(!is_null($request->generacion))
        {
            if($request->generacion!='todas')
                $alumnos=Alumno::where('generacion',$request->generacion)->get();
            else
                $alumnos=Alumno::all();

            return view('alumnos')->with('generaciones', $generaciones)->with('alumnos',$alumnos);
        }
        return view('alumnos')->with('generaciones', $generaciones);
    }


    function materias()
    {
        $materias=DB::table('kardex')->select('clave_materia')->addSelect('nombre_materia')->distinct('clave_materia')->OrderBy('nombre_materia')->get();


        return view('materias')->with('materias',$materias);
    }
}
