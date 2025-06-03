<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Izquierda -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Derecha -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="nav-icon fas fa-user"></i>
                <strong>{{ Auth::user()->name }}</strong>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-link nav-link" type="submit">
                        <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                    </button>
                </form>                
            </div>
        </li>
    </ul>    
</nav>