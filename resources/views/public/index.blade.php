@extends('layouts.public')

@section('title') Index @endsection

@section('content')

<h3 class="col-12 text-center">Advertisements</h3>
<div class="row">
    @foreach($adds as $add)
    <div class="card bg-light col-md-6">
        <div class="card-body">
            <img src="{{ $add->image_source }}" alt="" class="card-img-top">
        </div>
        @if($add->link!='')
        <div class="card-footer">
            <a href="{{ $add->link }}" target="_blank" rel="noopener noreferrer">Read more</a>
        </div>
        @endif
    </div>
    @endforeach
</div>

@endsection