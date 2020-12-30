@extends('layouts.app')

@section('title') Tenders @endsection

@section('content')
    <tender-content class="card col-lg-10" data="{{$tender_sections}}"></tender-content>
@endsection