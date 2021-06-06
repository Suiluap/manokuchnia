<!DOCTYPE html>
<html lang="lt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/functions.js') }}" defer></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Mano kuchnia</title>
    </head>
    <header class="mb-5">
        <nav class="navbar navbar-expand-md navbar-light bg-light shadow-sm">
            <a class="navbar-brand" href="{{ route('index') }}">Mano kuchnia</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
              </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarRecipesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Receptai
                        </a>
                        <div class="dropdown-menu shadow-sm" aria-labelledby="navbarRecipesDropdown">
                            @foreach ($categories as $category)
                                {{-- Gal reikėtų paduodi visą objektą, o ne tik id? bet tada lūžta --}}
                                <a class="dropdown-item" href="{{ route('recipes.category', $category->id) }}">{{$category->name}}</a>
                            @endforeach
                        </div>
                    </li>
                    @auth
                    <a class="nav-link" href="{{ route('recipes.new') }}">Naujas receptas</a>
                    @endauth
                </ul>

                <ul class="navbar-nav ml-auto">
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Prisijungti</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registruotis</a>
                    </li>
                    @endguest
                    @admin
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users') }}">Naudotojai</a>
                    </li>
                    @endadmin
                    @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarUserDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Aš
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="navbarUserDropdown">
                            <a class="dropdown-item" href="{{ route('recipes.user') }}">Receptai</a>
                            <a class="dropdown-item" href="{{ route('user') }}">Profilis</a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="dropdown-item">Atsijungti</button>
                            </form>
                        </div>
                    </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </header>
    <body class="bg-white">
        @yield('content')
    </body>
</html>
