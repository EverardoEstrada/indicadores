@extends('app')
@section('content')
<br>

<div class="container">
    <div class="p-3">
        <form action="">
            <div class="row">
                <p class="col-5">Seleccione la generacion que desea visualizar</p>
                <select class="col-3" name="generacion" id="">
                    <option value="todas">Todas</option>
                    @foreach ($generaciones as $generacion)
                        <option value="{{$generacion->año}}">{{$generacion->año}}</option>
                    @endforeach
                </select>
                <div class="col-1"></div>
                <button class="btn btn-primary col-2" type="submit">Buscar</button>
            </div>
        </form>
    </div>
</div>
<br>

@if(isset($alumnos))
<div class="container-fluid">
    <div >

        @foreach ($alumnos as $alumno)
        <div class="card p-3">
            <div class="row">
                <div class="col-3"><b>{{$alumno->nombre}}</b></div>
                <div class="col-2">Clave: {{ $alumno->clave_alumno}}</div>
                <div class="col-2">Clave larga: {{ $alumno->clave_larga}}</div>
                <div class="col-2">Status: {{ $alumno->situacion}}</div>
                <div class="col-3">Tutor: {{ $alumno->tutor}}</div>
                       <br>
            </div>
            <div class="row">
                <div class="col-2">Semestres Inscritos: {{$alumno->NumSemestresInscritos()}}</div>
                @if($alumno->situacion!='TITULADO' && $alumno->situacion!='BAJA DEFINITIVA' && $alumno->NumSemestresInscritos()>10)
                    <div class="col-2">Semestres Rezago: {{$alumno->NumSemestresInscritos()-10}}</div>
                @endif

            </div>
            <br>

            <div class="row">Semestres cursados por el alumno</div>
            <div class="row">
                @foreach ($alumno->SemestresInscritos() as $semestre)

                    <div class="col-1">{{$semestre->semestre}}</div>

                @endforeach
            </div>

        </div>
        <br>



        @endforeach


    </div>
</div>
@endif


@endsection
