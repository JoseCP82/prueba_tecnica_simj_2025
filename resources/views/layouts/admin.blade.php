<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Panel de Control')</title>

  <!-- AdminLTE -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

  @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('partials.navbar')

  @include('partials.sidebar')

  <!-- Contenido principal -->
  <div class="content-wrapper">
    <section class="content pt-3 px-3">
      @yield('content')
    </section>
  </div>

  @include('partials.footer')

</div>

<!-- Scripts -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>

@stack('scripts')
</body>
</html>
