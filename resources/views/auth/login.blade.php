<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">

    <div class="login-box">
        <div class="login-logo">
            <b>App</b> Tareas
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Inicia sesión para comenzar</p>

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (session('status'))
                <div class="alert alert-info">
                    {{ session('status') }}
                </div>
                @endif


                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Correo" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                        <div class="input-group-append">
                            <div class="input-group-text"><span class="fas fa-lock"></span></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">Recordarme</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                        </div>
                    </div>
                </form>

                <p class="mb-1 mt-3">
                    <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                </p>
                <p class="mb-0">
                    <a href="{{ route('register') }}" class="text-center">Registrarse</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>

</body>

</html>