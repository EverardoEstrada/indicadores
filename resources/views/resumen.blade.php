@extends('app')
@section('content')

<div class="container">
    <div class="p-3">
        <form action="">
            <div class="row">
                <p class="col-5">Seleccione la generacion que desea visualizar</p>
                <select class="col-3" name="generacion" id="">
                    <option value="todas">Todas</option>
                    @foreach ($generaciones as $gen)
                        <option value="{{$gen->año}}">{{$gen->año}}</option>
                    @endforeach
                </select>
                <div class="col-1"></div>
                <button class="btn btn-primary col-2" type="submit">Buscar</button>
            </div>
        </form>
    </div>
</div>
<br>


<div class="container">

    <br>
<h1>Resumen de la generacion {{$generacion}}</h1>

<br>
<table class="table table-bordered">
    <thead>
        <tr>
          <th class="table-info" scope="col" colspan="3" style="text-align: center; font-size:20px;" >Datos generales</th>
        </tr>
      </thead>
    <tbody>
        <tr>
          <th scope="row">Admitidos:</th>
          <td colspan="2">{{$admitidos}}</td>
        </tr>
        <tr>
            <th scope="row">Renuncias:</th>
            <td colspan="2">{{$renuncias}}</td>
        </tr>
        <tr>
            <th scope="row">Cambio Carrera:</th>
            <td colspan="2">{{$cambio_carrera}}</td>
        </tr>
        <tr>
            <th scope="row">Alumnos Persistentes:</th>
            <td colspan="2">{{$admitidos - $cambio_carrera}}</td>
        </tr>
        <tr>
            <th scope="row">Inscritos:</th>
            <td colspan="2">{{$inscritos}}</td>
        </tr>
    </tbody>
    <thead>
        <tr>
          <th class="table-info" scope="col" colspan="3" style="text-align: center; font-size:20px;" >Indice de reprobacion</th>
        </tr>
    </thead>
    <tbody>
        <tr>
          <th scope="row">Alumnos con 0 reprobadas:</th>
          <td>{{$reprobadas0}} </td>
          <td>({{ round(($reprobadas0/($admitidos)*100))}}%)</td>
        </tr>
        <tr>
            <th scope="row">Alumnos con 1 a 3 reprobadas:</th>
            <td>{{$reprobadas1a3}} </td>
            <td>({{ round(($reprobadas1a3/($admitidos)*100))}}%)</td>
        </tr>
        <tr>
            <th scope="row">Alumnos con 4 o mas reprobadas:</th>
            <td> {{$reprobadas4}} </td>
            <td>({{ round(($reprobadas4/($admitidos)*100))}}%)</td>
        </tr>
    </tbody>
</table>

<table class="table table-bordered">
    <thead>
        <tr>
          <th class="table-info" scope="col" colspan="100%" style="text-align: center; font-size:20px;" >Indice de rezago</th>
        </tr>
      </thead>
      <thead>
        <tr>
          <th class="table-light" scope="col" colspan="100%" style="text-align: center; " >Abandono: {{$abandonoTotal}} ({{round(($abandonoTotal/($admitidos - $cambio_carrera))*100)}}%)</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            @for ($i =1 ; $i <count($arregloAbandono); $i++)
            <th scope="row">S{{$i}}</th>
            @endfor
        </tr>
        <tr>
            @for ($i =1 ; $i <count($arregloAbandono); $i++)
            <td scope="row">{{$arregloAbandono[$i]}}</td>
            @endfor
        </tr>
        <tr>
            @for ($i =1 ; $i <count($arregloAbandono); $i++)
            <td scope="row">{{round(($arregloAbandono[$i]/$abandonoTotal)*100)}}%</td>
            @endfor
        </tr>
      </tbody>

</table>
<p> Alumnos que abandonaron en cada semestre </p>

<table class="table table-bordered">
    <thead>
        <tr>
          <th class="table-info" scope="col" colspan="100%" style="text-align: center; font-size:20px;" >Eficiencia Terminal</th>
        </tr>
      </thead>
      <thead>
        <tr>
            <th class="table-light" scope="col" colspan="33%" style="text-align: center;" >Retencion:{{round($egresados/$admitidos*100) }}%</th>
        </tr>
        <tr>
            <td class="table-light" scope="col" colspan="33%" style="text-align: center;" >Titulados:{{$titulados}}</td>
        </tr>
        <tr>
            <td class="table-light" scope="col" colspan="33%" style="text-align: center;" >Pasantes:{{$pasantes}}</td>
        </tr>
        <tr>
            <td class="table-light" scope="col" colspan="33%" style="text-align: center;" >Egresados:{{$egresados}}</td>
        </tr>
      </thead>
      <tbody>
        <tr>
            @for ($i =16 ; $i <count($arregloRezago); $i++)
            <th scope="row">S{{$i}}</th>
            @endfor
        </tr>
        <tr>
            @for ($i =16 ; $i <count($arregloRezago); $i++)
            <td scope="row">{{$arregloRezago[$i]}}</td>
            @endfor
        </tr>
      </tbody>

</table>

<p> Alumnos que tardaron mas de 15 semestres en acabar </p>
<br>
<br>
<br>

</div>


@endsection
