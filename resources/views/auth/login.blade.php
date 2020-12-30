@extends('layouts.auth')

@section('image')
    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
@endsection

@section('title')
    Login
@endsection

@section('form')
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
@endsection