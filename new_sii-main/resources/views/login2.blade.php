<!DOCTYPE html>
<html lang="es">

<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href={{ asset('css/miestilo.css') }}>
    <script src="https://kit.fontawesome.com/ee9903c79f.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container is-fluid">
        <div class="columns is-centered is-vcentered" style="height: 100vh;">
            <div class="column is-4">
                <div class="box">
                    <div class="is-flex is-align-items-center is-justify-content-center">
                        <figure class="image is-128x128 ">
                            <img class="is-rounded" src="img/logo.jpg">
                        </figure>
                    </div>
                    <h1 class="title is-5 has-text-centered">Sistema Integral de Información</h1>
                    <div class="field">
                        <label class="label">Correo Institucional</label>
                        <div class="control has-icons-left">
                            <input class="input is-rounded" type="email" placeholder="e.j. l20590359@sjuanrio.tecnm.mx">
                            <span class="icon is-small is-left">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Contraseña</label>
                        <div class="control has-icons-left">
                            <input class="input is-rounded" type="password" placeholder="********">
                            <span class="icon is-small is-left">
                                <i class="fas fa-key"></i>
                            </span>
                        </div>
                    </div>
                    <div class="has-text-centered">
                        <a class="button is-primary" href = "{{route('home')}}">Iniciar sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
