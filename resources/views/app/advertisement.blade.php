@extends('layouts.app')

@section('title') Advertisements @endsection

@section('content')
    <advertisements class="card col-lg-11" data="{{$advertisements}}"></advertisements>
@endsection