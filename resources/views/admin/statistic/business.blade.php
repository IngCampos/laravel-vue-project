@extends('layouts.app')

@section('title') Statistics - Business @endsection

@section('content')
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
            <basic-statistic :data="{{$advertisements}}"></basic-statistic>
        </div>
    </div>
</div>
<div class="col-12 col-md-6">
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tenders.</h6>
        </div>
        <div class="card-body">
            <basic-statistic-download :data="{{$tenders}}" :file_name="'Tender Section'" :column_name_type="'Section'"></basic-statistic-download>
        </div>
    </div>
</div>
@endsection