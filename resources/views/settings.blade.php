@extends('layouts.app')

@section('content')
<div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Settings.</h1>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card card-info">
                <div class="card-header">
                    Basic Information.
                </div>
                <p class="card-body text-justify">
                    <strong>Name</strong>: {{Auth::user()->name}}.<br />
                    <strong>Email(s)</strong>: {{Auth::user()->email}}.<br />
                    <strong>Department</strong>: {{Auth::user()->department->name}}.<br />
                    <strong>Created at</strong>: {{FormatDate(Auth::user()->created_at)}}.<br />
                    <strong>Updated at</strong>: {{FormatDate(Auth::user()->updated_at)}}.<br />
                </p>
            </div>
        </div>
        <div class=" col-12 col-md-6 col-xl-8">
            <div class="card">
                <div class="card-header">
                    Permissions.
                </div>
                <ul class="list-group text-justify">
                    @foreach (Auth::user()->permissions as $permission)
                    <li class="list-group-item">
                        <strong>{{$permission->name}}</strong>: {{$permission->description}}
                    </li>
                    @endforeach
                </ul>
                @if(Auth::user()->permissions=="[]")
                There are not permissions.
                @endif
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Update password.
                </div>
                <div class="card-body">
                    <update-password></update-password>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection