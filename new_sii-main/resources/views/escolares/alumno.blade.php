@extends('layouts.plantilla')
@section('content')
    <div class="box">
        <p class="title is-3 has-text-centered">Alumnos</p>
        
        <div class="buttons">
            <a href="{{route('home')}}" class="button is-danger">
                <i class="fa-solid fa-arrow-left"></i>&nbsp;Regresar
            </a>
            <a class="button is-primary js-modal-trigger" data-target="modal-nvo-alumno">
                <i class="fa-solid fa-plus"></i>&nbsp;Nuevo Alumno
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
                    <th>CURP</th>
                    <th>Semestre</th>
                    <th>Carrera</th>
                    <th>Estatus</th>
                    <th>Tipo de alumno</th>
                    <th class="has-text-centered">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alumnos as $alumno)
                    <tr>
                        <td>{{ $alumno->numero_control }}</td>
                        <td>{{ $alumno->ap_paterno . ' ' . $alumno->ap_materno . ' ' . $alumno->nombre}}</td>
                        <td>{{ $alumno->curp }}</td>
                        <td>{{ $alumno->semestre }}</td>
                        <td>{{ $alumno->planEstudio->carrera }}</td>
                        <td>{{ $alumno->estatus->nombre_estatus }}</td>
                        <td>{{ $alumno->tipoAlumno->nombre_tipo }}</td>
                        <td> {{-- botones --}}
                            <div class="field is-grouped">
                                {{-- Buton de Editar --}}
                                <button class="button is-warning js-modal-trigger" data-target="modal-update-{{ $alumno->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                {{-- Buton de Eliminar --}}
                                <form action="{{ route('alumnoDelete', $alumno->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button is-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar al alumno?')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>

                            {{-- =========== MODAL PARA EDITAR ALUMNO =========== --}}
                            <div id="modal-update-{{ $alumno->id }}" class="modal">
                                <div class="modal-background"></div>

                                <div class="modal-content">
                                    <div class="box">
                                        <p class="title is-5 has-text-centered">Modificar Alumno</p>
                                        <form method="POST" action="{{ route('alumnoUpdate', $alumno->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="field">
                                                <label class="label">Número de Control:</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="txtNoControlUp"
                                                        value="{{ $alumno->numero_control }}">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Nombre:</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="txtNombAlumnUp"
                                                    value="{{ $alumno->nombre }}">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Apellido Paterno:</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="txtApPatAlumnUp"
                                                    value="{{ $alumno->ap_paterno }}">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Apellido Materno:</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="txtApMatAlumnUp"
                                                    value="{{ $alumno->ap_materno }}">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">CURP:</label>
                                                <div class="control">
                                                    <input class="input" type="text" name="txtCURPAlumUp"
                                                    value="{{ $alumno->curp }}" maxlength="18">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Semestre:</label>
                                                <div class="control">
                                                    <input class="input" type="number" name="txtSemestreUp"
                                                    value="{{ $alumno->semestre }}">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Carrera:</label>
                                                <div class="control">
                                                    <div class="select">
                                                        <select name="selectCarreraAlumUp">
                                                            @foreach ($plan_estudios as $plan_estudio)
                                                                <option value="{{ $plan_estudio->id }}" 
                                                                    {{$plan_estudio->id == $alumno->plan_estudio_id ? 'selected' : '' }} >
                                                                    {{ $plan_estudio->carrera }} 
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                      </div>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Estatus:</label>
                                                <div class="control">
                                                    <div class="select">
                                                        <select name="selectEsatAlumUp">
                                                            @foreach ($estatus as $status)
                                                                <option value="{{ $status->id }}" 
                                                                    {{$status->id == $alumno->estatus_id ? 'selected' : '' }} >
                                                                    {{ $status->nombre_estatus }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                      </div>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Tipo de alumno:</label>
                                                <div class="control">
                                                    <div class="select">
                                                        <select name="selectTipoAlumUp">
                                                            @foreach ($tipos_alumno as $tipo_alumno)
                                                                <option value="{{ $tipo_alumno->id }}" {{$tipo_alumno->id == $alumno->tipo_alumno_id ? 'selected' : '' }}>{{ $tipo_alumno->nombre_tipo }}</option>
                                                            @endforeach
                                                        </select>
                                                      </div>
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
        <div id="modal-nvo-alumno" class="modal">
            <div class="modal-background"></div>
        
            <div class="modal-content">
                <div class="box">
                    <p class="title is-5 has-text-centered">Agregar alumno</p>
                    <form method="POST" action="{{ route('alumnoCreate') }}">
                        @csrf
                        @method('POST')
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Número de Control:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtNoControl" 
                                        value="{{ old('txtNoControl') }}">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtNoControl')
                                <p class="help is-danger">Ingresa el Número de control</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Nombre:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtNombAlumn" 
                                        value="{{ old('txtNombAlumn') }}">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtNombAlumn')
                                <p class="help is-danger">Ingresa el nombre del alumno</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Apellido Paterno:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtApPatAlumn" 
                                        value="{{ old('txtApPatAlumn') }}">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtApPatAlumn')
                                <p class="help is-danger">Ingresa el apellido del alumno</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Apellido Materno:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtApMatAlumn"
                                        value="{{ old('txtApMatAlumn') }}">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtApMatAlumn')
                                <p class="help is-danger">Ingresa el apellido del alumno</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">CURP:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtCURPAlum"
                                        value="{{ old('txtCURPAlum') }}" maxlength="18">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtCURPAlum')
                                <p class="help is-danger">Ingresa el CURP del alumno</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Semestre:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="number" name = "txtSemestre"
                                        value="{{ old('txtSemestre') }}">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtSemestre')
                                <p class="help is-danger">Ingresa el semestre del alumno</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Carrera:</label>
                                <div class="control has-icons-left">
                                    <div class="select">
                                        <select name="selectCarreraAlum">
                                            <option value="">Seleccionar</option>
                                            @foreach ($plan_estudios as $plan_estudio)
                                                <option value="{{ $plan_estudio->id }}" >
                                                    {{ $plan_estudio->carrera }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>                
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('selectCarreraAlum')
                                <p class="help is-danger">Ingresa la carrera del alumno</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Estatus:</label>
                                <div class="control has-icons-left">
                                    <div class="select">
                                        <select name="selectEsatAlum">
                                            <option value="">Seleccionar</option>
                                            @foreach ($estatus as $status)
                                                <option value="{{ $status->id }}" >
                                                    {{ $status->nombre_estatus }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>                
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('selectEsatAlum')
                                <p class="help is-danger">Ingresa el estatus del alumno</p>
                            @enderror
                        </div> 
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Tipo de alumno:</label>
                                <div class="control has-icons-left">
                                    <div class="select">
                                        <select name="selectTipoAlum">
                                            <option value="">Seleccionar</option>
                                            @foreach ($tipos_alumno as $tipo_alumno)
                                                <option value="{{ $tipo_alumno->id }}" >
                                                    {{ $tipo_alumno->nombre_tipo }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>                
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('selectTipoAlum')
                                <p class="help is-danger">Ingresa el estatus del alumno</p>
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