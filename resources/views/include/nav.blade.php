<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="navbar-expand" >
    <div class="nav">
        <div class="toggle-btn">                
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="container">

        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
            </ul>
 

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <div class="dropdown-item">
                                {{ __('ID: ') }}{{ Auth::user()->id }}
                            </div>
                            @if(Auth::user()->role == '1')
                                <a class="dropdown-item" href="/book-management">
                                    {{ __('Manage Books') }}
                                </a>
                                <a class="dropdown-item" href="/books/create">
                                    {{ __('Add Book') }}
                                </a>
                            @endif  

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <div class="sidebar active">
                        <div class="links">      
                            <a href="/dashboard">
                                <li class="fas-fa dashboard">Dashboard</li>
                            </a>
                            <a href="/books">
                                <li class="fas-fa books"> Books</li>
                            </a>
                            @if(Auth::user()->role == '1')
                                <a href="/issuebooks">
                                    <li class="fas-fa issuebooks"> Issued Books</li>
                                </a>
                                <a href="/returnbooks">
                                    <li class="fas-fa returnbooks"> To Return Books</li>
                                </a>
                                <a href="/students">
                                    <li class="fas-fa students"> Accounts </li>
                                </a> 
                            @endif  
                        </div>
                    </div> 
                @endguest
            </ul>
        </div>
    </div>
</nav>
        <div class="sidebar active">
            <div class="links">      
                <a href="/dashboard">
                    <li class="fas-fa dashboard"> Dashboard</li>
                </a>
                <a href="/books">
                    <li class="fas-fa books"> Books</li>
                </a>
            </div>     
        </div>
        <script src="{{asset("js/navbutton.js")}}"></script>
    </body>
</html>