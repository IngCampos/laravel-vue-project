<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.login.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-light bg-info">
        @if(Route::has('login'))
        @auth
        <a class="navbar-brand" href="{{ route('home') }}">Home</a>
        @else
        <a class="navbar-brand" href="{{ route('login') }}">Login</a>

        @if(Route::has('register'))
        <a class="navbar-brand" href="{{ route('register') }}">Register</a>
        @endif
        @endauth
        @endif
        <a class="navbar-brand" href="{{ route('blogs') }}">Blogs</a>
    </nav>
    <div class="row justify-content-center">
        @yield('content')
    </div>
    </div>
</body>

</html>