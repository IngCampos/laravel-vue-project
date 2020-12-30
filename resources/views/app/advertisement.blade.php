@extends('layouts.app')

@section('title') Advertisements @endsection

@section('content')
    <advertisement-content class="card col-lg-11" data="{{$advertisements}}"></advertisement-content>
@endsection