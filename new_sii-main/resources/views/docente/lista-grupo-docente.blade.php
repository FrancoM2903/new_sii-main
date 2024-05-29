@extends('layouts.plantilla')
@section('content')
    <div class="box">
        <p class="title is-3 has-text-centered">Lista de Alumnos</p>
        <p class="title is-5 has-text-centered">Grupos asignados</p>
        
        <div class="buttons">
            <a href="{{route('escolaresPlanesEstudio')}}" class="button is-danger">
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
                    <th>Plan Estudio</th>
                    <th>Materia</th>
                    <th>Grupo</th>
                    <th class="has-text-centered">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($docente->grupos as $grupo)
                    <tr>
                        <td>{{ $grupo->periodo->nombre_periodo }}</td>
                        <td>{{ $grupo->planEstudio->carrera }}</td>
                        <td>{{ $grupo->materia->nombre }}</td>
                        <td>{{ $grupo->semestre.$grupo->letra_grupo }}</td>
                        <td> {{-- botones --}}
                            <div class="field is-grouped has-text-centered">
                                <form action="{{ route('docenteGruposDocenteAlumno', $docente->id) }}#" method="GET">
                                    <button type="submit" class="button is-info" title="Listas">
                                        <i class="fa-solid fa-list"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>



@endsection