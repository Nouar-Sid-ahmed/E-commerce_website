<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Queue du Bonheur - @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/panier.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body <?php
    $id = Auth::id();
    $ip = $_SERVER['REMOTE_ADDR'];
    $ip_int = ip2long($ip);
    $ip_string = sprintf('%d',$ip_int);
    if(isset($_COOKIE['user'])){
        file_put_contents('../public/js/nbConnect.txt',$_COOKIE['user']);
        setcookie('user');
        unset($_COOKIE['user']);
    }
    echo 'onload="usecookie();userid('.$id.');ajax();newconnect('.$ip_string.');countProduct();displayPanier()" onclose="deconnect('.$ip_string.')"';
?>>

<header>

<a href="{{ asset('catalogue') }}" class="name">
    <img src="{{ asset('css/logo.png') }}">
</a>
<a class="item-menu" href="{{ route('catalogue') }}"><span>Catalogue</span></a>
@if (Auth::check())
        <a class="item-menu"  href="{{ route('panier') }} ">
    @else
                <a class="item-menu" href="{{ route('login') }}">
    @endif
<span id="nbPanier"></span></a>
        @if (Auth::check())
                    <a class="item-menu" href="{{ route('home') }}"><span>{{ Auth::user()->username }}</span></a>
        @else
        <a class="item-menu" href="{{ route('home') }}"><span>Se Connecter</span></a>
        @endif
</header>
<main>
    @yield('content')
</main>
<footer>
    <ul>
        <li><a href="https://twitter.com/" target="_blank">
                <img class="icon"
                     src="{{ asset('css/twitter.jpg') }}"
                     all="failled load" width="120" height="120">
            </a></li>
        <li><a href="https://www.facebook.com/" target="_blank">
                <img class="icon" src="{{ asset('css/facebook.png') }}"
                     all="failled load" width="120" height="120">
            </a></li>
    </ul>
    <p class="copy">Copyright &copy; BEST TEAM ETNA 2020</p>
</footer>
</body>
</html>
