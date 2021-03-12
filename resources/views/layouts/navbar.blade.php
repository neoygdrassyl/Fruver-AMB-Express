@section('navbar')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="" href="/"><img src="http:\\store.test\assets\fruver-img\LOGO.png" alt="" height="60"/></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item"><a class="nav-link" href="/tienda">Tienda</a></li>
                <li class="nav-item"><a class="nav-link" href="/#services">Nosotros</a></li>
                <li class="nav-item"><a class="nav-link" href="/#gallery">Galeria</a></li>
                <li class="nav-item"><a class="nav-link" href="/#contact">Contacto</a></li>
                <li class="nav-item"></li>
                
                <!-- Shopping Cart -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCart" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                    <dropdowncart-component></dropdowncart-component>
                </li>
                
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link js-scroll-trigger"  href="{{ route('login') }}">
                            <i class="fas fa-user"></i>
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <i class="fas fa-user"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/home">Administrar</a>
                            <a class="dropdown-item" href="/admin/productos">Productos</a>
                            <a class="dropdown-item" href="/admin/ordenes">Ordenes de Envio</a>
                            @if( Auth::user()->rol == 1 )
                            <a class="dropdown-item" href="/admin/users">Usuarios</a>
                            <a class="dropdown-item" href="/admin/audit">Auditoria</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                CERRAR SECION
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
@endsection