@extends('layouts.app')

@section('title') Edit post @endsection

@section('content')
    <div class="card col-12">
        <div class="form-group">
            <a href="{{route('posts.index')}}" class="btn btn-sm btn-secondary float-right btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Back</span>
            </a>
        </div>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        <!-- TODO: Show errors -->
        @endif
        <form action="{{route('posts.update', $post)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Title*</label>
                <input type="text" name="title" class="form-control" required value="{{old('title', $post->title)}}">
            </div>
            <div class="form-group">
                <label>Image</label>
                <input type="file" name="file" class="form-control">
            </div>
            <!-- TODO: Show the storage image -->
            <!-- TODO: Add an option for deleting the storaged image -->
            <div class="form-group">
                <label>Content*</label>
                <textarea name="body" rows="6" class="form-control" required>{{old('body', $post->body)}}</textarea>
            </div>
            <div class="form-group">
                <label>Embed content</label>
                <textarea name="iframe" class="form-control" value="{{old('iframe', $post->iframe)}}"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Update</span>
                </button>
            </div>
        </form>
    </div>
@endsection