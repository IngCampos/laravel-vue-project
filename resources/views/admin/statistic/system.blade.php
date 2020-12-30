@extends('layouts.app')

@section('title') Statistics - System @endsection

@section('content')
<div class="col-12 col-md-6">
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Users and departments.</h6>
        </div>
        <div class="card-body">
            <basic-statistic :data="{{$users}}"></basic-statistic>
        </div>
    </div>
</div>
<div class="col-12 col-md-6">
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Users and permissions.</h6>
        </div>
        <div class="card-body">
            <basic-statistic :data="{{$permissions}}"></basic-statistic>
        </div>
    </div>
</div>
@endsection