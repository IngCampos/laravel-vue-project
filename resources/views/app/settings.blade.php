@extends('layouts.app')

@section('title') Settings @endsection

@section('content')
    <div class="col-12 col-md-6 col-xl-4">
        <div class="card card-info">
            <div class="card-header">
                Basic Information.
            </div>
            <p class="card-body text-justify">
                <strong>Name</strong>: {{$user->name}}.<br />
                <strong>Email(s)</strong>: {{$user->email}}.<br />
                <strong>Department</strong>: {{$user->department->name}}.<br />
                <strong>Created at</strong>: {{FormatDate($user->created_at)}}.<br />
                <strong>Updated at</strong>: {{FormatDate($user->updated_at)}}.<br />
            </p>
        </div>
    </div>
    <div class=" col-12 col-md-6 col-xl-8">
        <div class="card">
            <div class="card-header">
                Permissions.
            </div>
            <ul class="list-group text-justify">
                @foreach ($permissions as $permission)
                <li class="list-group-item">
                    <strong>{{$permission->name}}</strong>: {{$permission->description}}
                </li>
                @endforeach
            </ul>
            @if($permissions=="[]")
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
                <form action="{{route('password.update')}}" method="POST" style="text-align:justify" class="row">
                    @csrf
                    <div class="form-group col-12 col-lg-6 row">
                        <label for="password" class="col-md-5 col-form-label">New password:</label>
                        <input class="form-control col-md-7" type="password" name="password" required minlength="8" maxlength="30" />
                    </div>
                    <div class="form-group col-12 col-lg-6 row">
                        <label for="password_confirmation" class="col-md-5 col-form-label">Repeat password:</label>
                        <input class="form-control col-md-7" type="password" name="password_confirmation" required minlength="8" maxlength="30" />
                    </div>
                    <center class="col-12">
                        <input type="submit" value="Update" class="btn btn-success" onclick="return confirm('Are you sure to update the password?')" />
                    </center>
                    @if($errors->any())
                    <div class="col-12">
                        @foreach($errors->all() as $error)
                        - {{ $error }} <br>
                        @endforeach
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection