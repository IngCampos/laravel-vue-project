@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Edit article
                <a href="{{route('posts.index')}}" class="btn btn-sm btn-primary float-right">Back</a>
            </div>
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
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
                    <div class="form-group">
                        <label>Content*</label>
                        <textarea name="body" rows="6" class="form-control" required>{{old('body', $post->body)}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Embbebed content</label>
                        <textarea name="iframe" class="form-control" value="{{old('iframe', $post->iframe)}}"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-sm btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection