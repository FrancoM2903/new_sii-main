@extends('layouts.plantilla')
@section('content')
    <div class="box">
        <p class="title is-3 has-text-centered">Alumnos inscritos en {{ $grupo->semestre }}{{ $grupo->letra_grupo }}</p>
        
        <div class="buttons">
            <a href="{{route('escolaresPlanesEstudio')}}" class="button is-danger">
                <i class="fa-solid fa-arrow-left"></i>&nbsp;Regresar
            </a>
            <a class="button is-primary js-modal-trigger" data-target="modal-nvo-alumno-gr">
                <i class="fa-solid fa-plus"></i>&nbsp;Nueva Materia
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
                    <th class="has-text-centered">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grupo->alumno as $alumnos)
                    <tr>
                        <td>{{ $alumnos->numero_control }}</td>
                        <td>{{ $alumnos->ap_paterno }} {{ $alumnos->ap_materno }} {{ $alumnos->nombre }}</td>
                        <td>{{ $alumnos->semestre }}</td>
                        <td> {{-- botones --}}
                            <div class="field is-grouped has-text-centered">
                                {{-- Buton de Eliminar --}}
                                <form action="{{ route('alumnoGrupoDelete', [$grupo->id, $alumnos->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button is-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar la materia?')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!--Modal para crear alumnos -->
       <div id="modal-nvo-alumno-gr" class="modal">
            <div class="modal-background"></div>
        
            <div class="modal-content">
                <div class="box">
                    <p class="title is-5 has-text-centered">Agregar Alumno</p>
                    <form method="POST" action="{{ route('alumnoGrupoCreate', $grupo->id) }}">
                        @csrf
                        @method('POST')
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Alumnos:</label>
                                <div class="control has-icons-left">
                                    <div class="select">
                                        <select name="selectAlumGru">
                                            <option value="">Seleccionar</option>
                                            @foreach ($alumno as $alumnos)
                                                <option value="{{ $alumnos->id }}">
                                                    {{ $alumnos->ap_paterno }} {{ $alumnos->ap_materno }} {{ $alumnos->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>                
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('selectAlumGru')
                                <p class="help is-danger">Ingresa la descripción del edificio</p>
                            @enderror
                        </div>     
                        <div class="has-text-centered">
                            <button class="button is-primary" type="submit"><i
                                    class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</a>
                        </div>
                    </form>
                </div>
            </div>
            <button class="modal-close is-large" aria-label="close"></button>
        </div>



    </div>

    @if ($errors->has('txtClave') || $errors->has('txtCarrera') )
        <script>
            document.getElementById('modal-nvo-plan').classList.add('is-active');
        </script>
    @endif


@endsection