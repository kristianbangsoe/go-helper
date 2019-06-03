<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container-fluid">
            <a class="navbar-brand ml-2" href="{{ url('/') }}">
                <img src="{{ asset('/assets/images/logo.png') }}" alt="{{config('app.name', 'Tak For hjælpen')}}">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
   
                @if (!Auth::guest())         
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/posts/">Find opgaver</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users/">Find Hjælper</a>
                    </li>
                </ul>
                @else
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/about/">Hvem er vi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/myposts/">Support</a>
                        </li>
                    </ul>
                @endif
              
         
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    {!! Form::open(['action' => 'PostsController@store', 'class' => 'form-inline mr-2', 'method' => 'POST']) !!}
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                            </div>
                            {{Form::search('search', '', ['class' => 'form-control', 'placeholder' => 'Kategori, Opgave, Stilling…'])}}
                        </div>
                        {{Form::submit('Submit', ['class' => 'hidden'])}}

                    {!! Form::close() !!}
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            @if (Route::has('register'))
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        </li>
                    @else
                        <li class="nav-item mx-2"><a class="btn btn-red" href="/posts/create/">Opret opgave</a></li>
                        <li class="nav-item dropdown">
                            
                            <a href="#" id="avatar" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <img src="/uploads/avatars/{{ Auth::user()->avatar }}">
                                {{ Auth::user()->name }} 
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/profile') }}">Profil</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
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