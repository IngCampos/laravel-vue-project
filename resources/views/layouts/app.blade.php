@extends('layouts.base')

@section('layout-name') LV Intranet @endsection

@section('head')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('body-attr') id="page-top" @endsection

@section('body')
    <div id="wrapper">
        @include('components.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('components.topbar')
                <main class="container-fluid">
                <div class="row justify-content-center" id="app">
                    @yield('content')
                </div>
                </main>
            </div>
            @include('components.footer')
        </div>
    </div>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
@endsection