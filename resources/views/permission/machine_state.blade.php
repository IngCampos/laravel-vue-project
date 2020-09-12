@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Machine state</h1>
</div>
<div class="card">
    <div class="card-body">
        <machine-state-content></machine-state-content>
    </div>
</div>
@endsection