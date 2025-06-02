<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Registro</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
</head>
<body class="hold-transition register-page">

<div class="register-box">
  <div class="register-logo">
    <b>App</b> Tareas
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Regístrate para iniciar sesión</p>

      @if ($errors->any())
      <div class="alert alert-danger">
          <ul class="mb-0">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif

      <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="input-group mb-3">
          <input type="text" name="name" class="form-control" placeholder="Nombre completo" value="{{ old('name') }}" required autofocus>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-user"></span></div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Correo electrónico" value="{{ old('email') }}" required>
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

        <div class="input-group mb-3">
          <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar contraseña" required>
          <div class="input-group-append">
            <div class="input-group-text"><span class="fas fa-lock"></span></div>
          </div>
        </div>

        <div class="form-group mb-3">
          <div class="icheck-primary">
            <input type="checkbox" id="is_admin" name="is_admin" value="1" {{ old('is_admin') ? 'checked' : '' }}>
            <label for="is_admin">Administrador</label>
          </div>
        </div>

        <div class="row">
          <div class="col-8">
            <a href="{{ route('login') }}" class="text-center">Ya tengo una cuenta</a>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>

</body>
</html>
