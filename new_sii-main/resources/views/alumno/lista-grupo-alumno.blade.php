@extends('layouts.plantilla')
@section('content')
    <div class="box">
        <p class="title is-3 has-text-centered">Materias Inscritas</p>
        
        <div class="buttons">
            <a href="{{--route('escolaresPlanesEstudio')--}}#" class="button is-danger">
                <i class="fa-solid fa-arrow-left"></i>&nbsp;Regresar
            </a>
        </div>

        @if (session('Correcto'))
            <div class="notification is-success">
                <button class="delete"></button>
                {{ session('Correcto') }}
            </div>
        @endif
        @if (session('Incorrecto'))
            <div class="notification is-danger">
                <button class="delete"></button>
                {{ session('Incorrecto') }}
            </div>
        @endif

        <table class="table is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th>Periodo</th>
                    <th>Plan</th>
                    <th>Materia</th>
                    <th>Grupo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alumno->grupo as $grupo)
                    @if ($grupo->periodo->estatus == 'En curso')
                        <tr>
                            <td>{{$grupo->periodo->clave_periodo.' '.$grupo->periodo->nombre_periodo}}</td>
                            <td>{{$grupo->planEstudio->carrera}}</td>
                            <td>{{$grupo->materia->nombre}}</td>
                            <td>{{$grupo->semestre.$grupo->letra_grupo}}</td>
                        </tr>
                    @endif
             @endforeach
            </tbody>
        </table>
@endsection