@extends('layouts.app_main')

@section('content')

<div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
<div class="col-lg-6">
    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-2">{{ __('Reset Password') }}</h1>
            <p class="mb-4">We get it, stuff happens. Just enter your email address below and we'll send you a link to reset your password!</p>
            @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <hr>
        </div>
        <form class="user" method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <input id="email" type="email" class="form-control form-control-user form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-Mail Address">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                {{ __('Send Password Reset Link') }}
            </button>
        </form>

        <hr>
        <div class="text-center">
            <a class="small" href="{{ route('login') }}">
                {{ __('Already have an account? Login!') }}
            </a>
        </div>
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