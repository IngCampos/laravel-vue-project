@extends('layouts.public')

@section('title') Contact @endsection

@section('content')
<div class="card col-12">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif
    <form action="{{route('complaint.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name*</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email*</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <span>Subject*</span>
            <select  class="form-control" name="complaint_type_id">
                @foreach ($complaint_types as $type)
                <option value="{{$type->id}}">{{$type->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Content*</label>
            <textarea name="content" rows="6" class="form-control" required></textarea>
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