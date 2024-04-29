@extends('layouts.plantilla')

@section('content')
    {{-- <h1 class="title is-4">Estamos en el home</h1> --}}
    <div class="box box-principal">
        <div class="columns is-multiline is-mobile">
            <div class="column is-4-desktop is-6-mobile">
                <div class="box">
                    <h1 class="title is-6 "><i class="fa-solid fa-users"></i> Alumnos</h1>
                    <p>Ver, crear, editar alumnos</p><br>
                    <a  class="button is-info" href="{{route('escolaresAlumnos')}}">Acceder</a>
                </div>
            </div>
            <div class="column is-4-desktop is-6-mobile">
                <div class="box">
                    <h1 class="title is-6 "><i class="fa-solid fa-address-card"></i> Docentes</h1>
                    <p>Ver, crear, editar docentes</p><br>
                    <a  class="button is-info" href="{{route('escolaresDocente')}}">Acceder</a>
                </div>
            </div>
            <div class="column is-4-desktop is-6-mobile">
                <div class="box">
                    <h1 class="title is-6 "><i class="fa-solid fa-people-roof"></i> Grupos</h1>
                    <p>Ver, crear, editar grupos</p><br>
                    <a  class="button is-info" href="{{route('escolaresAlumnos')}}">Acceder</a>
                </div>
            </div>
            <div class="column is-4-desktop is-6-mobile">
                <div class="box">
                    <h1 class="title is-6 "><i class="fa-solid fa-building"></i> Edificios y Salones</h1>
                    <p>Ver, crear, editar alumnos</p><br>
                    <a  class="button is-info" href="{{route('escolaresEdificios')}}">Acceder</a>
                </div>
            </div>
            <div class="column is-4-desktop is-6-mobile">
                <div class="box">
                    <h1 class="title is-6 "><i class="fa-solid fa-book-open"></i> Materias</h1>
                    <p>Ver, crear, editar alumnos</p><br>
                    <a  class="button is-info" href="{{route('escolaresAlumnos')}}">Acceder</a>
                </div>
            </div>
            <div class="column is-4-desktop is-6-mobile">
                <div class="box">
                    <h1 class="title is-6 "><i class="fa-solid fa-address-card"></i> Planes de estudio</h1>
                    <p>Ver, crear, editar los planes de estudio</p><br>
                    <a  class="button is-info" href="{{route('escolaresPlanesEstudio')}}">Acceder</a>
                </div>
            </div>
            <div class="column is-4-desktop is-6-mobile">
                <div class="box">
                    <h1 class="title is-6 "><i class="fa-solid fa-address-card"></i> Especialidades</h1>
                    <p>Ver, crear, editar alumnos</p><br>
                    <a  class="button is-info" href="{{route('escolaresAlumnos')}}">Acceder</a>
                </div>
            </div>
        </div>
    </div>
@endsection
