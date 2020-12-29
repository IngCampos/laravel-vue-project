@php
/*
* with the route name, options
* (about login, create account and password forgotten)
* are enable o disable.
*/
$route = Request::route()->getName();
@endphp

@if(Route::has('register') && $route!='register')
<div class="text-center">
    <a class="small" href="{{ route('register') }}">
        {{ __('Create an Account!') }}
    </a>
</div>
@endif

@if(Route::has('password.request') && $route!="password.request")
<div class="text-center">
    <a class="small" href="{{ route('password.request') }}">
        {{ __('Forgot Your Password?') }}
    </a>
</div>
@endif

@if(Route::has('login') && $route!='login')
<div class="text-center">
    <a class="small" href="{{ route('login') }}">
        {{ __('Already have an account? Login!') }}
    </a>
</div>
@endif

<div class="text-center">
    <a href="{{ route('index') }}">
        <strong>
            {{ __('Go to the home') }}
        </strong>
    </a>
</div>