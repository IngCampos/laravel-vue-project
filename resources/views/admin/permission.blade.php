@extends('layouts.app')

@section('title') Permissions @endsection

@section('content')
    <permissions class="col-xl-6 col-lg-8 col-md-10" data="{{$permissions}}"></permissions>
@endsection