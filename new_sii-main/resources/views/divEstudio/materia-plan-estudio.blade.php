@extends('layouts.plantilla')
@section('content')
    <div class="box">
        <p class="title is-3 has-text-centered">Materias de {{ $planEstudio->carrera }}</p>
        
        <div class="buttons">
            <a href="{{route('escolaresPlanesEstudio')}}" class="button is-danger">
                <i class="fa-solid fa-arrow-left"></i>&nbsp;Regresar
            </a>
            <a class="button is-primary js-modal-trigger" data-target="modal-nvo-materia">
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
                    <th>Clave Materia</th>
                    <th>Nombre</th>
                    <th>Creditos</th>
                    <th class="has-text-centered">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($planEstudio->materias as $materia)
                    <tr>
                        <td>{{ $materia->calve_materia }}</td>
                        <td>{{ $materia->nombre }}</td>
                        <td>{{ $materia->creditos }}</td>
                        <td> {{-- botones --}}
                            <div class="field is-grouped has-text-centered">
                                {{-- Buton de Eliminar --}}
                                <form action="{{ route('materiaPlanEstudioDelete', [$planEstudio->id, $materia->id]) }}" method="POST">
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
        <div id="modal-nvo-materia" class="modal">
            <div class="modal-background"></div>
        
            <div class="modal-content">
                <div class="box">
                    <p class="title is-5 has-text-centered">Agregar Materia</p>
                    <form method="POST" action="{{ route('materiaPlanEstudioCreate', $planEstudio->id) }}">
                        @csrf
                        @method('POST')
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Materia:</label>
                                <div class="control has-icons-left">
                                    <div class="select">
                                        <select name="selectMatPlan">
                                            <option value="">Seleccionar</option>
                                            @foreach ($materias as $materia)
                                                <option value="{{ $materia->id }}">
                                                    {{ $materia->calve_materia }} - {{ $materia->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>                
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('selectEdificios')
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