<header>
    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel z-index">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                LaraPictures
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>
                <ul class="navbar-nav ml-auto">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Ingresar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                    </li class="nav-item">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/home') }}">Cuenta</a>
                    </li class="nav-item">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.index')}}">Buscar persona</a>
                    </li class="nav-item">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('likes')}}">Favoritas</a>
                    </li class="nav-item">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('image.create') }}">Subir imagen</a>
                    </li>
                    <li class="nav-item dropdown d-flex">
                        @include('includes.avatar')
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile', ['id' => Auth::user()->id]) }}">
                                Mi perfil
                            </a>
                            <a class="dropdown-item" href="{{ route('config') }}">
                                Configuración
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Cerrar sesión') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>