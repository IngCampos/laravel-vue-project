@extends('layouts.base')

@section('head')
    <!-- Styles -->
    <link href="{{ asset('css/public.css') }}" rel="stylesheet">
@endsection

@section('body')
    @include('components.nav')
    <div class="container">
        <div class="align-items-center justify-content-between mb-4">
            @yield('content')
        </div>
    </div>
    @include('components.footer')
@endsection