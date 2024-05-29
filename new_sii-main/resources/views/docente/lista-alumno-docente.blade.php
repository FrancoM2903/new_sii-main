@extends('layouts.plantilla')
@section('content')
    <div class="box">
        <p class="title is-3 has-text-centered">Gestion de Alumnos</p>
        <p class="title is-5 has-text-centered">
            {{ 
                $grupos->materia->nombre.' - Grupo: '.
                $grupos->letra_grupo.' - '.
                $grupos->docente->ap_paterno.' '.
                $grupos->docente->ap_materno.' '.
                $grupos->docente->nombre
            }}
        </p>
        
        <div class="buttons">
            <a href="{{route('docenteGruposDocente',Auth::user()->docente->id)}}" class="button is-danger">
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
                    <th>No. Control</th>
                    <th>Nombre Completo</th>
                    <th>Semestre</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grupos->alumno as $alumno)
                    <tr>
                        <td>{{ $alumno->id }}</td>
                        <td>{{ $alumno->ap_paterno. ' '.$alumno->ap_materno.' '. $alumno->nombre }}</td>
                        <td>{{ $alumno->semestre }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection