<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Alumno;
use App\Models\Kardex;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;

class AlumnosController extends Controller
{
    function index(Request $request)
    {
        $generaciones=DB::table('alumnos')->select('generacion as año')->distinct()->get();
        $user = Auth::user();

        if(!is_null($request->generacion))
        {
            if($request->generacion!='todas')
            {
                if($user->hasAnyRole('admin','Jefe de Area','Coordinador') )
                    $alumnos=Alumno::where('generacion',$request->generacion)->get();
                else if($user->hasRole('Asesor'))
                    $alumnos=Alumno::where('generacion',$request->generacion)->where('tutor',$user->name)->get();
                else
                    $alumnos=Alumno::where('tutor','-')->get();
            }
            else
            {
                if($user->hasAnyRole('admin','Jefe de Area','Coordinador') )
                    $alumnos=Alumno::all();
                else if($user->hasRole('Asesor'))
                    $alumnos=Alumno::where('tutor',$user->name)->get();
                else
                    $alumnos=Alumno::where('tutor','-')->get();
            }


            return view('alumnos')->with('generaciones', $generaciones)->with('alumnos',$alumnos);
        }
        return view('alumnos')->with('generaciones', $generaciones);
    }


    function materias()
    {
        $materias=DB::table('kardex')->select('clave_materia')->addSelect('nombre_materia')->distinct('clave_materia')->OrderBy('nombre_materia')->get();


        return view('materias')->with('materias',$materias);
    }

    function Resumen(Request $request) {

        if(!is_null($request->generacion))
        $generacion=$request->generacion;
        else
        $generacion=2021;

        $generaciones=DB::table('alumnos')->select('generacion as año')->distinct()->get();
        //para sacar admitidos
        $admitidos=Alumno::where('generacion',$generacion)->count();

        //para sacar renuncias
        //tabla->wherenotIn('dato q sirve para comparar','consulta de coleccion donde no debe estar')
        $renuncia=DB::table('alumnos')
                    ->whereNotIn(
                        'clave_alumno',
                        DB::table('kardex')
                            ->select('clave_alumno')
                            ->distinct()
                    )
                    ->where('generacion',$generacion)
                    ->count();

        //alumnos con cambio de carrera
        $cambio_carrera=DB::table('alumnos')->where('clave_larga', 'like', '%4____')->where('generacion',$generacion)->count();

        //alumnos inscritos
        $inscritos=DB::table('alumnos')->where('situacion','INSCRITO')
                    ->where('generacion',$generacion)
                    ->where(function (Builder $query) {
                        $query->where('clave_larga', 'like', '%0____')
                            ->orWhere('clave_larga', 'like', '%7____');
                    })->count();

        //alumnos con 0 materias reprobadas
        $reprobadas0=DB::table('alumnos')->where('materias_reprobadas',0)->where('generacion',$generacion)->count();

        //alumnos con 1 a 3 materias reprobadas
        $reprobadas1a3=DB::table('alumnos')->where('materias_reprobadas','>',0)->where('materias_reprobadas','<=',3)->where('generacion',$generacion)->count();

        //alumnos con 4 o mas materias reprobadas
        $reprobadas4=DB::table('alumnos')->where('materias_reprobadas','>',0)->where('materias_reprobadas','>=',4)->where('generacion',$generacion)->count();

        //alumnos que abandonan
        //SELECT COUNT(*) FROM alumnos WHERE situacion<>'TITULADO' and situacion<>'INSCRITO' and situacion<>'PASANTE' AND generacion=2020
        $abandonoTotal=DB::table('alumnos')->where('situacion','<>','TITULADO')->where('situacion','<>','INSCRITO')->where('situacion','<>','PASANTE')->where('generacion',$generacion)->count();

        //arreglo de a los cuantos semestres abandono cada alumno
        /*
        SELECT count(distinct kardex.semestre) AS semestres FROM alumnos
        INNER JOIN kardex on alumnos.clave_alumno =kardex.clave_alumno
        WHERE situacion<>'TITULADO' and situacion<>'INSCRITO' and situacion<>'PASANTE' AND generacion=2020
        GROUP BY alumnos.id
        ORDER BY semestres
        */
        $colleccionAbandono=DB::table('alumnos')
                        ->select( DB::raw(" count(distinct kardex.semestre) AS semestres"))
                        ->join('kardex','kardex.clave_alumno','=','alumnos.clave_alumno')
                        ->where('alumnos.situacion','<>','TITULADO')
                        ->where('alumnos.situacion','<>','INSCRITO')
                        ->where('alumnos.situacion','<>','PASANTE')
                        ->where('generacion',$generacion)
                        ->groupBy('alumnos.id')
                        ->orderBy('alumnos.id')
                        ->get();

        //Obtencion del mayor numero de semestres en el que abandono un alumno
        $mayor=0;
        foreach ($colleccionAbandono as $i)
            if($mayor<$i->semestres)    $mayor=$i->semestres;

        //colocado en orden de semestre => numero alumnos que abandono    EX: sem 2, 5 alum   formato (indice,valor)
        $arregloAbandono=[];
        for ($i=0; $i <=$mayor ; $i++) {array_push($arregloAbandono,0);}
        foreach ($colleccionAbandono as $i) {$arregloAbandono[$i->semestres]++;}

        //alumnos titulados
            $titulados=DB::table('alumnos')->where('alumnos.situacion','TITULADO')->where('generacion',$generacion)->count();
        //alumnos pasantes
            $pasantes=DB::table('alumnos')->where('alumnos.situacion','PASANTE')->where('generacion',$generacion)->count();
        //alumnos egresados
            $egresados=$titulados+$pasantes;

        //alumnos con n semestres de rezago (de 16 para arriba)
        $colleccionRezago=DB::table('alumnos')
                        ->select( DB::raw(" count(distinct kardex.semestre) AS semestres"))
                        ->join('kardex','kardex.clave_alumno','=','alumnos.clave_alumno')
                        ->where(function (Builder $query) {
                            $query->where('alumnos.situacion','TITULADO')
                                    ->orWhere('alumnos.situacion','PASANTE');
                        })
                        ->where('generacion',$generacion)
                        ->groupBy('alumnos.id')
                        ->orderBy('alumnos.id')
                        ->get();

        $mayor=0;
        foreach ($colleccionRezago as $i)
            if($mayor<$i->semestres)    $mayor=$i->semestres;
            if($mayor<20) $mayor=20;

        $arregloRezago=[];
        for ($i=0; $i <=$mayor ; $i++) {array_push($arregloRezago,0);}
        foreach ($colleccionRezago as $i) {$arregloRezago[$i->semestres]++;}








        return view("resumen")
            ->with('admitidos',$admitidos)
            ->with('renuncias',$renuncia)
            ->with('cambio_carrera',$cambio_carrera)
            ->with('inscritos',$inscritos)
            ->with('reprobadas0',$reprobadas0)
            ->with('reprobadas1a3',$reprobadas1a3)
            ->with('reprobadas4',$reprobadas4)
            ->with('abandonoTotal',$abandonoTotal)
            ->with('arregloAbandono',$arregloAbandono)
            ->with('titulados',$titulados)
            ->with('pasantes',$pasantes)
            ->with('egresados',$egresados)
            ->with('arregloRezago',$arregloRezago)
            ->with('generacion',$generacion)
            ->with('generaciones',$generaciones);



    }
}
