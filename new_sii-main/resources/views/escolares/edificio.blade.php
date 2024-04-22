@extends('layouts.plantilla')
@section('content')
    <div class="block">
        <p class="title is-3 has-text-centered">Edificios y Salones</p>
        
        <div class="buttons">
            <a href="{{route('home')}}" class="button is-danger">
                <i class="fa-solid fa-arrow-left"></i>&nbsp;Regresar
            </a>
            <a class="button is-primary js-modal-trigger" data-target="modal-nvo-plan">
                <i class="fa-solid fa-plus"></i>&nbsp;Nuevo Edificio
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
    </div>

    <div class="columns">
        <div class="column">
            <div class="box">
                <table class="table is-striped is-narrow is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th>Edificio</th>
                        <th>Descripción</th>
                        <th class="has-text-centered">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($edificios as $item)
                        <tr>
                            <td>{{ $item->nombre_edificio }}</td>
                            <td>{{ $item->descripcion }}</td>
                            <td>
                                <div class="field is-grouped has-text-is-centered">
                                    <button class="button is-warning js-modal-trigger" data-target="modal-{{ $item->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <form action="{{ route('edificioDelete', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button is-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar el edificio?')">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
    
                                <div id="modal-{{ $item->id }}" class="modal">
                                    <div class="modal-background"></div>
    
                                    <div class="modal-content">
                                        <div class="box">
                                            <p class="title is-5 has-text-centered">Modificar Edificio</p>
                                            <form method="POST" action="{{ route('edificioUpdate', $item->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <div class="field">
                                                    <label class="label">Edificio:</label>
                                                    <div class="control">
                                                        <input class="input" type="text" name="txtEdificio"
                                                            value="{{ $item->nombre_edificio }}">
                                                    </div>
                                                </div>
                                                <div class="field">
                                                    <label class="label">Descripción:</label>
                                                    <div class="control">
                                                        <input class="input" type="text" name="txtDescripcion"
                                                        value="{{ $item->descripcion }}">
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
                            <p class="title is-5 has-text-centered">Agregar Edificio</p>
                            <form method="POST" action="{{ route('edificioCreate') }}">
                                @csrf
                                @method('POST')
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <label class="label">Edificio:</label>
                                        <div class="control has-icons-left">
                                            <input class="input" type="text" name = "txtEdificio" value="{{ old('txtEdificio') }}">
                
                                            <span class="icon is-small is-left">
                                                <i class="fa-solid fa-key"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @error('txtEdificio')
                                        <p class="help is-danger">Ingresa el Edificio</p>
                                    @enderror
                                </div>
                                <div class="field">
                                    <div class="control has-icons-left">
                                        <label class="label">Descripción:</label>
                                        <div class="control has-icons-left">
                                            <input class="input" type="text" name = "txtDescripcion" value="{{ old('txtDescripcion') }}">
                
                                            <span class="icon is-small is-left">
                                                <i class="fa-solid fa-graduation-cap"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @error('txtDescripcion')
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
        </div>

        <div class="column">
            <div class="box">

            </div>
        </div>
    </div>

    

    @if ($errors->has('txtEdificio') || $errors->has('txtDescripcion') )
        <script>
            document.getElementById('modal-nvo-plan').classList.add('is-active');
        </script>
    @endif


@endsection