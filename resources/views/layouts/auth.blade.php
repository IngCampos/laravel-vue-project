@extends('layouts.base')

@section('head')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.login.css') }}" rel="stylesheet">
@endsection

@section('body-attr') class="bg-gradient-primary" @endsection

@section('body')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            @yield('image')
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">
                                            <strong>
                                                @yield('title')
                                            </strong>
                                        </h1>
                                        @yield('info')
                                        <hr>
                                    </div>
                                    @yield('form')
                                    <hr>
                                    @include('components.login_links')
                                    <hr>
                                    @include('components.footer')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection    