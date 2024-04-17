@extends('layouts.plantilla')
@section('content')
    <div class="box">
        <p class="title is-3 has-text-centered">Planes de estudio</p>
        
        <div class="buttons">
            <a href="{{route('home')}}" class="button is-danger">
                <i class="fa-solid fa-arrow-left"></i>&nbsp;Regresar
            </a>
            <a class="button is-primary js-modal-trigger" data-target="modal-nvo-plan">
                <i class="fa-solid fa-plus"></i>&nbsp;Nuevo Plan
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
                    <th>Plan de Estudio</th>
                    <th>Carrera</th>
                    <th class="has-text-centered">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($planes as $item)
                    <tr>
                        <td>{{ $item->clave_plan_estudio }}</td>
                        <td>{{ $item->carrera }}</td>
                        <td>
                            <div class="field is-grouped">
                                <button class="button is-warning js-modal-trigger" data-target="modal-{{ $item->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <form action="{{ route('PlanesEstudioEliminar', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button is-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este plan de estudios?')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>

                            <div id="modal-{{ $item->id }}" class="modal">
                                <div class="modal-background"></div>

                                <div class="modal-content">
                                    <div class="box">
                                        <p class="title is-5 has-text-centered">Modificar Plan de Estudio</p>
                                        <form method="POST" action="{{ route('planEstudioUpdate', $item->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="field">
                                                <label class="label">Clave del Plan de Estudios:</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="txtClave"
                                                        value="{{ $item->clave_plan_estudio }}">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Nombre de la carrera:</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="txtCarrera"
                                                    value="{{ $item->carrera }}">
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

        <!--Modal para crear un nuevo plan -->
        <div id="modal-nvo-plan" class="modal">
            <div class="modal-background"></div>
        
            <div class="modal-content">
                <div class="box">
                    <p class="title is-5 has-text-centered">Agregar Plan de Estudio</p>
                    <form method="POST" action="{{ route('PlanesEstudioCrear') }}">
                        @csrf
                        @method('POST')
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Clave del Plan de Estudios:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtClave" value="{{ old('txtClave') }}">
        
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtClave')
                                <p class="help is-danger">Ingresa la clave del plan de estudios</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Nombre de la carrera:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtCarrera"
                                        value="{{ old('txtCarrera') }}">
        
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtCarrera')
                                <p class="help is-danger">Ingresa el nombre de la carrera</p>
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
