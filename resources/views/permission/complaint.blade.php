@extends('layouts.app')

@section('content')
<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Complaints</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <complaint-content></complaint-content>
        </div>
        <center>
            <small>To answer it is necessary to have an email client.</small>
        </center>
    </div>
</div>
@endsection