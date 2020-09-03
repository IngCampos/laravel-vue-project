@extends('layouts.app')

@section('content')
<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Advertisements</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <advertisement-content></advertisement-content>
        </div>
    </div>
</div>
@endsection