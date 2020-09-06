@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Statistics - Business</h1>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Complaints.</h6>
                </div>
                <div class="card-body">
                    <detail-complaint></detail-complaint>
                </div>
            </div>
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Advertisements.</h6>
                </div>
                <div class="card-body">
                    <detail-advertisement></detail-advertisement>
                </div>
            </div>
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Machine state.</h6>
                </div>
                <div class="card-body">
                    <detail-machine></detail-machine>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tenders.</h6>
                </div>
                <div class="card-body">
                    <detail-tender></detail-tender>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection