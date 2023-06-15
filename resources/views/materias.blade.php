@extends('app')
@section('content')

<div class="container">
    <div class="p-3">
        <form action="">
            <div class="row">
                <p class="col-5">Seleccione la materia que desea visualizar</p>
                <select class="col-3" name="generacion" id="">
                    @foreach ($materias as $materia)
                        <option value="{{$materia->clave_materia}}">{{$materia->clave_materia}} {{$materia->nombre_materia}}</option>
                    @endforeach
                </select>
                <div class="col-1"></div>
                <button class="btn btn-primary col-2" type="submit">Buscar</button>
            </div>
        </form>
    </div>
</div>

@endsection
