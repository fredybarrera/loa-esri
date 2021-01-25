<nav class="layout-navbar navbar navbar-expand-lg align-items-lg-center bg-navbar-theme container-p-x" id="layout-navbar">

    <!-- Brand -->
    <a href="{{ route('home') }}" class="navbar-brand">
        <img src="/images/esri_logo.jpg" alt class="d-block ui-w-140 rounded-circle">
    </a>


    @empty($hide_layout_sidenav_toggle)
    <!-- Sidenav toggle -->
    <div class="layout-sidenav-toggle navbar-nav align-items-lg-center mr-auto mr-lg-4">
        <a class="nav-item nav-link px-0 ml-2" href="javascript:void(0)">
            <i class="ion ion-md-menu text-large align-middle"></i>
        </a>
    </div>
    @endempty

    <!-- Navbar toggle -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#layout-navbar-collapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="layout-navbar-collapse">
        <div class="navbar-nav align-items-lg-center">
            <div class="nav-item"><a class="nav-link" href="#">Link 1</a></div>
            <div class="nav-item"><a class="nav-link" href="#">Link 2</a></div>
        </div>
    </div>


    <!-- Divider -->
    <div class="nav-item d-none d-lg-block text-big font-weight-light line-height-1 opacity-25 mr-3 ml-1">|</div>

    <div class="demo-navbar-user nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
            <span class="d-inline-flex flex-lg-row-reverse align-items-center align-middle">
                <img src="/images/avatars/{{ Auth::user()->foto }}" alt class="d-block ui-w-30 rounded-circle">
                <span class="px-1 mr-lg-2 ml-2 ml-lg-0">{{ Auth::user()->nombres }} {{ Auth::user()->apellidos }} ({{ Session::get(App\Define::SESSION_PERFIL_ACTIVO)->nombre }})</span>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a href="javascript:void(0)" class="dropdown-item"><i class="ion ion-ios-person"></i> &nbsp; Mi perfil</a>
            @if(sizeof(Auth::user()->perfiles) > 1)
                <a href="{{ url('/cambiarPerfil') }}" class="dropdown-item">
                    <i class="ion ion-md-repeat"></i> 
                    <span class="text"> &nbsp; Cambiar perfil</span>
                </a>
            @endif
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ url('/auth/logout') }}">
                <i class="ion ion-ios-log-out text-danger"></i> &nbsp; {{ __('Logout') }}
            </a>
        </div>
    </div>
</nav>
