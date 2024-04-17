<div>
    <!-- Walk as if you are kissing the Earth with your feet. - Thich Nhat Hanh -->
</div>

@extends('layouts.plantilla')
@section('content')
    <div class="box">
        <p class="title is-3 has-text-centered">Docentes</p>
        
        <div class="buttons">
            <a href="{{route('home')}}" class="button is-danger">
                <i class="fa-solid fa-arrow-left"></i>&nbsp;Regresar
            </a>
            <a class="button is-primary js-modal-trigger" data-target="modal-nvo-plan">
                <i class="fa-solid fa-plus"></i>&nbsp;Nuevo Docente
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
                    <th>RFC</th>
                    <th>Nombre Completo</th>
                    <th>CURP</th>
                    <th>Email</th>
                    <th class="has-text-centered">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($docentes as $item)
                    <tr>
                        <td>{{ $item->rfc }}</td>
                        <td>{{ $item->ap_paterno . ' ' . $item->ap_materno . ' ' . $item->nombre}}</td>
                        <td>{{ $item->curp }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <div class="field is-grouped">
                                <button class="button is-warning js-modal-trigger" data-target="modal-{{ $item->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <form action="{{ route('docenteDelete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button is-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar al docente?')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>

                            <div id="modal-{{ $item->id }}" class="modal">
                                <div class="modal-background"></div>

                                <div class="modal-content">
                                    <div class="box">
                                        <p class="title is-5 has-text-centered">Modificar Plan de Estudio</p>
                                        <form method="POST" action="{{ route('docenteUpdate', $item->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="field">
                                                <label class="label">RFC:</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="txtRFC"
                                                        value="{{ $item->rfc }}">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Nombre:</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="txtNombre"
                                                    value="{{ $item->nombre }}">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Apellido Paterno:</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="txtApPaterno"
                                                    value="{{ $item->ap_paterno }}">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Apellido Materno:</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="txtApMaterno"
                                                    value="{{ $item->ap_materno }}">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">CURP:</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="txtCURP"
                                                    value="{{ $item->curp }}">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Email:</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="txtEmail"
                                                    value="{{ $item->email   }}">
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
                    <p class="title is-5 has-text-centered">Agregar Docente</p>
                    <form method="POST" action="{{ route('docenteCreate') }}">
                        @csrf
                        @method('POST')
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">RFC:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtRFC" value="{{ old('txtRFC') }}">
        
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtRFC')
                                <p class="help is-danger">Ingresa el RFC</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Nombre:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtNombre"
                                        value="{{ old('txtNombre') }}">
        
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtNombre')
                                <p class="help is-danger">Ingresa el nombre del docente</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Apellido Paterno:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtApPaterno"
                                        value="{{ old('txtApPaterno') }}">
        
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtApPaterno')
                                <p class="help is-danger">Ingresa el apellido del docente</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Apellido Materno:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtApMaterno"
                                        value="{{ old('txtApMaterno') }}">
        
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtApMaterno')
                                <p class="help is-danger">Ingresa el apellido del docente</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">CURP:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtCURP"
                                        value="{{ old('txtCURP') }}">
        
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtCURP')
                                <p class="help is-danger">Ingresa el CURP del docente</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Email:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="email" name = "txtEmail"
                                        value="{{ old('txtEmail') }}">
        
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtEmail')
                                <p class="help is-danger">Ingresa el correo electrónico del docente</p>
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