<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        {{-- Fonte do Google --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

        {{-- Bootstrap --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

        {{-- Style e JS --}}
        <link rel="stylesheet" href="/css/style.css">
        <script src="/js/script.js"></script>

    </head>
    <body>

        {{-- Cabeçalho --}}
        <header>
            <nav class="navbar navbar-expand-lg navbar-light"> {{-- Menu --}}
                <div class="collapse navbar-collapse" id="navbar"> 

                    <a href="" class="navbar-brand">  {{-- Ícone Menu --}}
                        <img src="/img/iconMenu.png" alt="ícone de girassol">
                    </a> {{-- Fim Ícone Menu --}}

                    <ul class="navbar-nav">  {{-- Itens menu --}}
                        <li class="nav-item">
                            <a href="/" class="nav-link">Projetos</a>
                        </li>
                        <li class="nav-item">
                            <a href="/events/create" class="nav-link">Criar Projetos</a>
                        </li>
                        @auth  {{-- se o usuário estiver logado --}}
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link">Meus Projetos</a>
                        </li>
                        {{-- Logout --}}
                        <li class="nav-item">  
                            <form action="/logout" method="POST">
                                @csrf
                                <a href="/logout" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();" >Sair</a>
                            </form>
                        </li>
                        @endauth
                        @guest
                        <li class="nav-item">
                            <a href="/login" class="nav-link">Sign in</a>
                        </li>
                        <li class="nav-item">
                            <a href="/register" class="nav-link">Sign up</a>
                        </li>
                        @endguest                        
                    </ul> {{-- Fim Itens menu --}}

                </div>
            </nav> {{-- Fim Menu --}}

        </header>  {{-- Fim Cabeçalho --}}
       

        {{-- Área do conteúdo que mudará de página para página --}}
        <main>
            <div class="container-fluid">
                <div class="row">
                    @if(session('msg'))
                    <p class="msg">{{ session('msg') }}</p>
                    @endif
                    @yield('content')
                </div>
            </div>
        </main>
        {{-- Fim Área do conteúdo dinâmica --}}

        {{-- Rodapé --}}
        <footer>
            <p>Natália Bernini &copy; 2023</p>
        </footer>
        {{-- Fim Rodapé --}}

        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>

    </body>
</html>
