@extends('layouts.plantilla')
@section('content')
    <div class="box">
        <p class="title is-3 has-text-centered">Grupos de {{ $planEstudio->carrera }}</p>
        
        <div class="buttons">
            <a href="{{route('escolaresPlanesEstudio')}}" class="button is-danger">
                <i class="fa-solid fa-arrow-left"></i>&nbsp;Regresar
            </a>
            <a class="button is-primary js-modal-trigger" data-target="modal-nvo-grupo">
                <i class="fa-solid fa-plus"></i>&nbsp;Nuevo Grupo
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
                    <th>Letra Grupo</th>
                    <th>Periodo</th>
                    <th>Materia</th>
                    <th>Semestre</th>
                    <th>Docente</th>
                    <th>Capacidad</th>
                    <th class="has-text-centered">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($planEstudio->grupos as $grupo)
                    <tr>
                        <td>{{ $grupo->letra_grupo }}</td>
                        <td>{{ $grupo->periodo->nombre_periodo }}</td>
                        <td>{{ $grupo->materia->nombre }}</td>
                        <td>{{ $grupo->semestre }}</td>
                        <td>{{ $grupo->docente->ap_paterno.' '.
                                $grupo->docente->ap_materno.' '.
                                $grupo->docente->nombre }}
                        </td>
                        <td>{{ $grupo->capacidad }}</td>
                        <td> {{-- botones --}}
                            <div class="field is-grouped has-text-centered">
                                <button class="button is-warning js-modal-trigger" data-target="modal-update-{{ $grupo->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                {{-- Buton de Eliminar --}}
                                <form action="{{ route('grupoDelete', [$planEstudio->id, $grupo->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button is-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar la materia?')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                                <form action="{{ route('divEstAlumGrupo', $grupo->id) }}#" method="GET">
                                    <button type="submit" class="button is-info" title="Listas">
                                        <i class="fa-solid fa-list"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <div id="modal-update-{{ $grupo->id }}" class="modal">
                        <div class="modal-background"></div>
                        <div class="modal-content">
                            <div class="box">
                                <p class="title is-5 has-text-centered">Modificar Grupo</p>
                                <form method="POST" action="{{ route('grupoUpdate', [$planEstudio->id, $grupo->id] ) }}">
                                    @csrf
                                    @method('PATCH')
                                    <div class="field">
                                        <label class="label">Letra de grupo:</label>
                                        <div class="control">
                                            <input class="input" type="text" name="txtLetraGrupoUp"
                                                value="{{ $grupo->letra_grupo }}">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Periodo:</label>
                                        <div class="control">
                                            <div class="select">
                                                <select name="selectPeriGrupoUp">
                                                    @foreach ($periodos as $periodo)
                                                        @if ($periodo->estatus != 'cerrado')
                                                            <option value="{{ $periodo->id }}">
                                                                {{ $periodo->nombre_periodo }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>                
                                        </div>
                                    </div>
                                    
                                    <div class="field">
                                        <label class="label">Materia:</label>
                                        <div class="control">
                                            <div class="select">
                                                <select name="selectMatGrupUp">
                                                    @foreach ($materias as $materia)
                                                        <option value="{{ $materia->id }}">
                                                            {{ $materia->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>                
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Semestre:</label>
                                        <div class="control">
                                            <input class="input" type="number" name="txtSemGrupoUp"
                                            value="{{ $grupo->semestre }}">
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Docente:</label>
                                        <div class="control">
                                            <div class="select">
                                                <select name="selectDocenGrupUp">
                                                    @foreach ($docentes as $docente)
                                                        <option value="{{ $docente->id }}">
                                                            {{ $docente->ap_paterno }} {{ $docente->ap_materno }} {{ $docente->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>                
                                        </div>
                                    </div>
                                    <div class="field">
                                        <label class="label">Capacidad:</label>
                                        <div class="control">
                                            <input class="input" type="number" name="txtCapGrupoUp"
                                            value="{{ $grupo->capacidad }}">
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
                @endforeach
            </tbody>
        </table>

        <!--Modal para crear alumnos -->
        <div id="modal-nvo-grupo" class="modal">
            <div class="modal-background"></div>
        
            <div class="modal-content">
                <div class="box">
                    <p class="title is-5 has-text-centered">Agregar Grupo</p>
                    <form method="POST" action="{{ route('grupoCreate', $planEstudio->id) }}">
                        @csrf
                        @method('POST')
                        <div class="field">
                            <label class="label">Letra de grupo:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="text" name = "txtLetraGrupo" 
                                    value="{{ old('txtLetraGrupo') }}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                            @error('txtLetraGrupo')
                                <p class="help is-danger">Ingresa la letra del grupo</p>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="label">Periodo:</label>
                            <div class="control has-icons-left">
                                <div class="select">
                                    <select name="selectPeriGrupo">
                                        <option value="">Seleccionar</option>
                                        @foreach ($periodos as $periodo)
                                            @if ($periodo->estatus != 'Cerrado')
                                                <option value="{{ $periodo->id }}">
                                                    {{ $periodo->nombre_periodo }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>                
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                            @error('selectPeriGrupo')
                                <p class="help is-danger">Ingresa el periodo</p>
                            @enderror
                        </div> 
                        <div class="field">
                            <label class="label">Materia:</label>
                            <div class="control has-icons-left">
                                <div class="select">
                                    <select name="selectMatGrup">
                                        <option value="">Seleccionar</option>
                                        @foreach ($materias as $materia)
                                            <option value="{{ $materia->id }}">
                                                {{ $materia->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>                
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                            @error('selectMatGrup')
                                <p class="help is-danger">Ingresa la materia del grupo</p>
                            @enderror
                        </div>
                        <div class="field">
                            <label class="label">Semestre:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="number" name = "txtSemGrupo" 
                                    value="{{ old('txtSemGrupo') }}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                            @error('txtSemGrupo')
                                <p class="help is-danger">Ingresa el semestre de grupo</p>
                            @enderror
                        </div> 
                        <div class="field">
                            <label class="label">Docente:</label>
                            <div class="control has-icons-left">
                                <div class="select">
                                    <select name="selectDocenGrup">
                                        <option value="">Seleccionar</option>
                                        @foreach ($docentes as $docente)
                                            <option value="{{ $docente->id }}">
                                                {{ $docente->ap_paterno }} {{ $docente->ap_materno }} {{ $docente->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>                
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-graduation-cap"></i>
                                </span>
                            </div>
                            @error('selectDocenGrup')
                                <p class="help is-danger">Ingresa el docente del grupo</p>
                            @enderror
                        </div> 
                        <div class="field">
                            <label class="label">Capacidad:</label>
                            <div class="control has-icons-left">
                                <input class="input" type="number" name = "txtCapGrupo" 
                                    value="{{ old('txtCapGrupo') }}">
                                <span class="icon is-small is-left">
                                    <i class="fa-solid fa-key"></i>
                                </span>
                            </div>
                            @error('txtCapGrupo')
                                <p class="help is-danger">Ingresa la capacidad del grupo</p>
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