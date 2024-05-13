@extends('layouts.plantilla')
@section('content')
    <div class="box">
        <p class="title is-3 has-text-centered">Gestión de Periodos</p>
        
        <div class="buttons">
            <a href="{{route('home')}}" class="button is-danger">
                <i class="fa-solid fa-arrow-left"></i>&nbsp;Regresar
            </a>
            <a class="button is-primary js-modal-trigger" data-target="modal-nvo-periodo">
                <i class="fa-solid fa-plus"></i>&nbsp;Nuevo Periodo
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
                    <th>Clave Periodo</th>
                    <th>Nombre del Periodo</th>
                    <th>Estatus</th>
                    <th class="has-text-centered">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($periodos as $periodo)
                    <tr>
                        <td>{{ $periodo->clave_periodo }}</td>
                        <td>{{ $periodo->nombre_periodo }}</td>
                        <td>{{ $periodo->estatus }}</td>
                        <td> {{-- botones --}}
                            <div class="field is-grouped">
                                {{-- Buton de Editar --}}
                                <button class="button is-warning js-modal-trigger" data-target="modal-update-{{ $periodo->id }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                {{-- Buton de Eliminar --}}
                                <form action="{{ route('periodoDelete', $periodo->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button is-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar al periodo?')">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>

                            {{-- =========== MODAL PARA EDITAR ALUMNO =========== --}}
                            <div id="modal-update-{{ $periodo->id }}" class="modal">
                                <div class="modal-background"></div>

                                <div class="modal-content">
                                    <div class="box">
                                        <p class="title is-5 has-text-centered">Modificar Periodo</p>
                                        <form method="POST" action="{{ route('periodoUpdate', $periodo->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <div class="field">
                                                <label class="label">Año:</label>
                                                <div class="control">
                                                    <div class="select">
                                                        <select name="selectAnioPeriUp">
                                                            <option value="20" 
                                                                {{-- selectAnioPeriUp == '20' ? 'selected' : ''--}}>
                                                                2020
                                                            </option>
                                                            <option value="21" 
                                                                {{-- selectAnioPeriUp == '21' ? 'selected' : ''--}}>
                                                                2021
                                                            </option>
                                                            <option value="22" 
                                                                {{-- selectAnioPeriUp == '22' ? 'selected' : ''--}}>
                                                                2022
                                                            </option>
                                                            <option value="23" 
                                                                {{-- selectAnioPeriUp == '23' ? 'selected' : ''--}}>
                                                                2023
                                                            </option>
                                                            <option value="24" 
                                                                {{-- selectAnioPeriUp == '24' ? 'selected' : ''--}}>
                                                                2024
                                                            </option>
                                                            <option value="25" 
                                                                {{-- selectAnioPeriUp == '25' ? 'selected' : ''--}}>
                                                                2025
                                                            </option>
                                                            <option value="26" 
                                                                {{-- selectAnioPeriUp == '26' ? 'selected' : ''--}}>
                                                                2026
                                                            </option>
                                                        </select>
                                                      </div>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Periodo:</label>
                                                <div class="control">
                                                    <div class="select">
                                                        <select name="selectPeriodoPerUp">
                                                            <option value="1" 
                                                                {{-- $edificio->id == $salon->edificio_id ? 'selected' : '' --}}>
                                                                Enero - Junio
                                                            </option>
                                                            <option value="2" 
                                                                {{-- $edificio->id == $salon->edificio_id ? 'selected' : '' --}}>
                                                                Agosto - Diciembre
                                                            </option>
                                                            <option value="3" 
                                                                {{-- $edificio->id == $salon->edificio_id ? 'selected' : '' --}}>
                                                                Verano
                                                            </option>
                                                        </select>
                                                      </div>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <label class="label">Estatus:</label>
                                                <div class="control">
                                                    <div class="select">
                                                        <select name="selectEstatusPeriUp">
                                                            <option value="Cerrado" 
                                                                {{-- $edificio->id == $salon->edificio_id ? 'selected' : '' --}}>
                                                                Cerrado
                                                            </option>
                                                            <option value="En curso" 
                                                                {{-- $edificio->id == $salon->edificio_id ? 'selected' : '' --}}>
                                                                En curso
                                                            </option>
                                                            <option value="Preparación" 
                                                                {{-- $edificio->id == $salon->edificio_id ? 'selected' : '' --}}>
                                                                Preparación
                                                            </option>
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
        <div id="modal-nvo-periodo" class="modal">
            <div class="modal-background"></div>
        
            <div class="modal-content">
                <div class="box">
                    <p class="title is-5 has-text-centered">Crear Periodo</p>
                    <form method="POST" action="{{ route('periodoCreate') }}">
                        @csrf
                        @method('POST')
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Año:</label>
                                <div class="control has-icons-left">
                                    <div class="select">
                                        <select name="selectAnioPeri">
                                            <option value="20" 
                                                {{-- $edificio->id == $salon->edificio_id ? 'selected' : '' --}}>
                                                2020
                                            </option>
                                            <option value="21" 
                                                {{-- $edificio->id == $salon->edificio_id ? 'selected' : '' --}}>
                                                2021
                                            </option>
                                            <option value="22" 
                                                {{-- $edificio->id == $salon->edificio_id ? 'selected' : '' --}}>
                                                2022
                                            </option>
                                            <option value="23" 
                                                {{-- $edificio->id == $salon->edificio_id ? 'selected' : '' --}}>
                                                2023
                                            </option>
                                            <option value="24" 
                                                {{-- $edificio->id == $salon->edificio_id ? 'selected' : '' --}}>
                                                2024
                                            </option>
                                            <option value="25" 
                                                {{-- $edificio->id == $salon->edificio_id ? 'selected' : '' --}}>
                                                2025
                                            </option>
                                            <option value="26" 
                                                {{-- $edificio->id == $salon->edificio_id ? 'selected' : '' --}}>
                                                2026
                                            </option>
                                        </select>
                                    </div>
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
                                </div>
                            </div>
                            @error('selectAnioPeri')
                                <p class="help is-danger">Ingresa la clave del periodo</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Periodo:</label>
                                <div class="control has-icons-left">
                                    <div class="select">
                                        <select name="selectPeriodoPer">
                                            <option value="1" 
                                                {{-- $edificio->id == $salon->edificio_id ? 'selected' : '' --}}>
                                                Enero - Junio
                                            </option>
                                            <option value="2" 
                                                {{-- $edificio->id == $salon->edificio_id ? 'selected' : '' --}}>
                                                Agosto - Diciembre
                                            </option>
                                            <option value="3" 
                                                {{-- $edificio->id == $salon->edificio_id ? 'selected' : '' --}}>
                                                Verano
                                            </option>
                                        </select>
                                    </div>
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('selectPeriodoPer')
                                <p class="help is-danger">Ingresa el nombre del periodo</p>
                            @enderror
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Estatus:</label>
                                <div class="control has-icons-left">
                                    <div class="select">
                                        <select name="selectEstatusPeri">
                                            <option value="Cerrado" 
                                                {{-- $edificio->id == $salon->edificio_id ? 'selected' : '' --}}>
                                                Cerrado
                                            </option>
                                            <option value="En curso" 
                                                {{-- $edificio->id == $salon->edificio_id ? 'selected' : '' --}}>
                                                En curso
                                            </option>
                                            <option value="Preparación" 
                                                {{-- $edificio->id == $salon->edificio_id ? 'selected' : '' --}}>
                                                Preparación
                                            </option>
                                        </select>
                                    </div>
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            @error('selectEstatusPeri')
                                <p class="help is-danger">Ingresa el estatus del periodo</p>
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
