<nav class="navbar navbar-expand bg-gradient-primary navbar-dark bg-white topbar mb-4 static-top shadow">
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <div class="sidebar-brand-text navbar-brand mx-3">
        <strong>
            <a class="navbar-brand" href="{{ route('index') }}"> {{ config('app.name', 'Laravel') }}</a>
        </strong>
    </div>
    <ul class=" navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>
        <li class="nav-item dropdown no-arrow">
            <a class="navbar-brand" href="{{ route('index') }}">Index</a>
            <a class="navbar-brand" href="{{ route('blogs') }}">Blog</a>
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
        </li>
    </ul>
</nav>