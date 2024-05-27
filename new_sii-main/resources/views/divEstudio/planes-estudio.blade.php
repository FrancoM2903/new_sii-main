@extends('layouts.plantilla')
@section('content')
    <div class="box">
        <p class="title is-3 has-text-centered">Planes de Estudio y Especialiadades</p>
        
        <div class="buttons">
            <a href="{{route('home')}}" class="button is-danger">
                <i class="fa-solid fa-arrow-left"></i>&nbsp;Regresar
            </a>
            <a class="button is-primary js-modal-trigger" data-target="modal-nvo-plan">
                <i class="fa-solid fa-plus"></i>&nbsp;Nuevo Plan
            </a>
            <a class="button is-primary js-modal-trigger" data-target="modal-nva-especialidad">
                <i class="fa-solid fa-plus"></i>&nbsp;Nueva Especialidad
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

        <div class="columns">
            <div class="column">
                <div class="box">
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
                                            
                                            <form action="{{ route('escolaresMateriaPlanEstudio', $item->id) }}" method="GET">
                                                <button type="submit" class="button is-info" title="Ver Materias">
                                                    <i class="fa-solid fa-book"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('escolaresGrupo', $item->id) }}" method="GET">
                                                <button type="submit" class="button is-info" title="Ver Grupos">
                                                    <i class="fa-solid fa-people-roof"></i>
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
                    </table> {{-- FIN TABLA DE PLANES DE ESTUDIOS --}}
                </div> {{-- FIN BOX DE COLUMN 1 --}}
            </div> {{-- FIN COLUMN 1 (PLANES DE ESTUCIO) --}}

            <div class="column">
                <div class="box">
                    <table class="table is-striped is-narrow is-hoverable is-fullwidth">
                        <thead>
                            <tr>
                                <th>Clave de Especiaidad</th>
                                <th>Nombre de Especialidad</th>
                                <th>Plan de Estudio de la Especialidad</th>
                                <th class="has-text-centered">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($especialidades as $especialidad)
                                <tr>
                                    <td>{{ $especialidad->clave_especialidad }}</td>
                                    <td>{{ $especialidad->especilidad }}</td>
                                    <td>{{ $especialidad->planEstudio->carrera }}</td>
                                    <td>
                                        <div class="field is-grouped">
                                            <button class="button is-warning js-modal-trigger" data-target="modal-up-especialidad-{{ $especialidad->id }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <form action="{{ route('especialidadDelete', $especialidad->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button is-danger" {{-- $especialidad->especialidsades->count() > 0 ? 'disabled':'' --}} onclick="return confirm('¿Estás seguro de que quieres eliminar esta especialidad?')">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>

                                        {{-- MODAL PARA MODIFICAR ESPECILIDAD --}}
                                        <div id="modal-up-especialidad-{{ $especialidad->id }}" class="modal">
                                            <div class="modal-background"></div>
                                            <div class="modal-content">
                                                <div class="box">
                                                    <p class="title is-5 has-text-centered">Modificar Especialidad</p>
                                                    <form method="POST" action="{{ route('especialidadUpdate', $especialidad->id) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="field">
                                                            <label class="label">Clave de la Especialidad:</label>
                                                            <div class="control">
                                                                <input class="input" type="text" name="txtClaveEsp_Up"
                                                                    value="{{ $especialidad->clave_especialidad }}">
                                                            </div>
                                                        </div>
                                                        <div class="field">
                                                            <label class="label">Nombre de la Especialidad:</label>
                                                            <div class="control">
                                                                <input class="input" type="text" name="txtEspecialidad_Up"
                                                                value="{{ $especialidad->especilidad }}">
                                                            </div>
                                                        </div>
                                                        <div class="field">
                                                            <label class="label">Edificio:</label>
                                                            <div class="control">
                                                                <div class="select">
                                                                    <select name="selectPlanEsp_Up">
                                                                        @foreach ($planes as $plan)
                                                                            <option value="{{ $plan->id }}" {{$plan->id == $especialidad->plan_estudio_id ? 'selected' : '' }}>{{ $plan->carrera }}</option>
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
                                        </div> {{-- FIN DE MODAL MODIFICAR ALUMNOS --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> {{-- TABLA DE PLANES DE ESTUDIOS --}}
                </div> {{-- BOX DE COLUMN 2 --}}

            </div> {{-- COLUMN 2 (ESPECIALIDADES) --}}

        </div> {{-- COLUMNS --}}



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

        <!--Modal para crear un nuevo especialidad -->
        <div id="modal-nva-especialidad" class="modal">
            <div class="modal-background"></div>
        
            <div class="modal-content">
                <div class="box">
                    <p class="title is-5 has-text-centered">Agregar Especialidad:</p>
                    <form method="POST" action="{{ route('especialidadCreate') }}">
                        @csrf
                        @method('POST')
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Clave de la Especialidad:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtClaveEsp" value="{{ old('txtClaveEsp') }}">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtClaveEsp')
                                <p class="help is-danger">Ingresa la clave de la especialidad</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Nombre de la Especialidad:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtEspecialidad" value="{{ old('txtEspecialidad') }}">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('txtEspecialidad')
                                <p class="help is-danger">Ingresa el nombre de la especialidad</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Edificio:</label>
                                <div class="control has-icons-left">
                                    <div class="select">
                                        <select name="selectPlanEsp">
                                            <option value="">Seleccionar</option>
                                            @foreach ($planes as $plan)
                                                <option value="{{ $plan->id }}">{{ $plan->carrera }}</option>
                                            @endforeach
                                        </select>
                                    </div>                
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('selectPlanEsp')
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
