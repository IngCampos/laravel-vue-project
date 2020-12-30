@extends('layouts.app')

@section('title') Tenders @endsection

@section('content')
    <tenders class="card col-lg-10" data="{{$tender_sections}}"></tenders>
@endsection