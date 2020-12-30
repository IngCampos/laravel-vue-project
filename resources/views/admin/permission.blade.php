@extends('layouts.app')

@section('title') Permissions @endsection

@section('content')
    <permission-content class="card col-xl-6 col-lg-8 col-md-10" data="{{$permissions}}"></permission-content>
@endsection