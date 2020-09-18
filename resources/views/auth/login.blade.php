@extends('layouts.app_main')

@section('content')

<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
<div class="col-lg-6">
    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">
                <strong>
                    {{ config('app.name', 'Laravel') }}
                </strong>
            </h1>
            <hr>
        </div>
        <form method="POST" action="{{ route('login') }}" class="user">
            @csrf
            <div class="form-group">
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror form-control-user" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror form-control-user" name="password" required autocomplete="current-password" placeholder="Password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <span for="remember">
                    {{ __('Remember Me') }}
                </span>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                {{ __('Log in') }}
            </button>
        </form>

        <hr>
        @if(Route::has('password.request'))
        <div class="text-center">
            <a class="small" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        </div>
        @endif
        <div class="text-center">
            <a class="small" href="{{ route('register') }}">
                {{ __('Create an Account!') }}
            </a>
        </div>
        <hr>
        <div class="text-center">
            <a href="{{ url('/') }}">
                <strong>
                    {{ __('Go to the home') }}
                </strong>
            </a>
        </div>
        <div class="text-center">
            {{ config('app.name', 'Laravel') }}
        </div>
    </div>
</div>

@endsection