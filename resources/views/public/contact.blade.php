@extends('layouts.public')

@section('title') Contact @endsection

@section('content')
<div class="card col-12">
    @if($errors->any())
    <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $error)
        - {{ $error }} <br>
        @endforeach
    </div>
    @endif
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{route('complaint.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name*</label>
            <input type="text" name="name" class="form-control" required value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label>Email*</label>
            <input type="email" name="email" class="form-control" required value="{{old('email')}}">
        </div>
        <div class="form-group">
            <span>Subject*</span>
            <select  class="form-control" name="complaint_type_id" value="{{old('complaint_type_id')}}">
                @foreach ($complaint_types as $type)
                <option value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Content*</label>
            <textarea name="content" rows="6" class="form-control" required>{{old('content')}}</textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-save"></i>
                </span>
                <span class="text">Send your message</span>
            </button>
        </div>
    </form>
</div>
@endsection