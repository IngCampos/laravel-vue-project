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
    <nav class="navbar navbar-expand bg-gradient-primary navbar-dark bg-white topbar mb-4 static-top shadow">
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <div class="sidebar-brand-text navbar-brand mx-3"><strong>
                <a class="navbar-brand" href="{{ route('welcome') }}"> {{ config('app.name', 'Laravel') }}</a>
            </strong> </div>
        <ul class=" navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
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
                <a class="navbar-brand" href="{{ route('blogs') }}">Blog</a>
            </li>
        </ul>
    </nav>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="card">
                @yield('content')
            </div>
        </div>
    </div>
    @include('layouts.footer')
    </div>
</body>

</html>