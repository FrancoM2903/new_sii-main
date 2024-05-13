@extends('layouts.plantilla')
@section('content')
    <div class="box">
        <p class="title is-3 has-text-centered">Materias</p>
        
        <div class="buttons">
            <a href="{{route('home')}}" class="button is-danger">
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
                @foreach ($materias as $materia)
                    <tr>
                        <td>{{ $materia->calve_materia }}</td>
                        <td>{{ $materia->nombre }}</td>
                        <td>{{ $materia->creditos }}</td>
                        <td> {{-- botones --}}
                            <div class="field is-grouped">
                                {{-- Buton de Editar --}}
                                <button class="button is-warning js-modal-trigger" data-target="modal-update-{{ $materia->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                {{-- Buton de Eliminar --}}
                                <form action="{{ route('materiaDelete', $materia->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button is-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar al alumno?')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>

                            {{-- =========== MODAL PARA EDITAR ALUMNO =========== --}}
                            <div id="modal-update-{{ $materia->id }}" class="modal">
                                <div class="modal-background"></div>

                                <div class="modal-content">
                                    <div class="box">
                                        <p class="title is-5 has-text-centered">Modificar Materia</p>
                                        <form method="POST" action="{{ route('materiaUpdate', $materia->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="field">
                                                <label class="label">Clave de Materia:</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="txtClaveMatUp"
                                                        value="{{ $materia->calve_materia }}">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Nombre:</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="txtNombMatUp"
                                                    value="{{ $materia->nombre }}">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Créditos:</label>
                                                <div class="control">
                                                    <input class="input" type="number" name="txtCredMatUp"
                                                    value="{{ $materia->creditos }}">
                                                </div>
                                            </div>
                                            <div class="has-text-centered">
                                                <button class="button is-primary" type="submit">Guardar</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <button class="modal-close is-large" aria-label="close"></button>
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
                    <p class="title is-5 has-text-centered">Modificar Materia</p>
                    <form method="POST" action="{{ route('materiaCreate') }}">
                        @csrf
                        @method('POST')
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Clave de la Materia:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtClaveMat" 
                                        value="{{ old('txtClaveMat') }}">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtClaveMat')
                                <p class="help is-danger">Ingresa el nombre de la materia</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Nombre de materia:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtNombMat" 
                                        value="{{ old('txtNombMat') }}">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtNombMat')
                                <p class="help is-danger">Ingresa el nombre de la materia</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Créditos:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="number" name = "txtCredMat" 
                                        value="{{ old('txtCredMat') }}">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtCredMat')
                                <p class="help is-danger">Ingresa el número de créditos por la materia</p>
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
