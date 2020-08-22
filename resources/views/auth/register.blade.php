@extends('layouts.app_main')

@section('content')

<div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
<div class="col-lg-7">
    <div class="p-5">
        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
        </div>
        <form class="user" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input id="name" type="text" class="form-control form-control-user @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <select id="department_id" type="text" class="form-control-user form-control @error('department_id') is-invalid @enderror" name="department_id" value="{{ old('department_id') }}" required autocomplete="department_id">
                        <option disabled>Select the department</option>
                        @foreach (App\Department::orderBy('name')->get() as $department)
                        <option value="{{ $department->id }}">{{$department->name}}</option>
                        @endforeach
                    </select>
                    @error('department_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat Password">
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
                {{ __('Register Account') }}
            </button>
        </form>
        <hr>
        <div class="text-center">
            <a class="small" href="{{ route('password.request') }}">
                {{ __('Forgot Password?') }}
            </a>
        </div>
        <div class="text-center">
            <a class="small" href="{{ route('login') }}">
                {{ __('Already have an account? Login!') }}
            </a>
        </div>
        <hr>
        <div class="text-center">
            <a class="small" href="{{ url('/') }}">
                {{ __('Go to the home') }}
            </a>
        </div>
        <div class="text-center">
            {{ config('app.name', 'Laravel') }}
        </div>
    </div>
</div>

@endsection