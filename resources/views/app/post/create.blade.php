@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Posts</h1>
</div>
<div class="card">
    <div class="card-header">
        Create article
        <a href="{{route('posts.index')}}" class="btn btn-sm btn-secondary float-right btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Back</span>
        </a>
    </div>
    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        <!-- TODO: Show errors -->
        @endif
        <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Title*</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="file" class="form-control">
            </div>
            <div class="form-group">
                <label>Content*</label>
                <textarea name="body" rows="6" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label>Embed content</label>
                <textarea name="iframe" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Create</span>
                </button>
            </div>
        </form>
    </div>
</div>

@endsection