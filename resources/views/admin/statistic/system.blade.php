@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Statistics - System</h1>
    </div>
    <div class="row">
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
    </div>
</div>
@endsection