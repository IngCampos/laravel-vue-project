@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Posts</h1>
</div>
<div class="card">
    <div class="card-header">
        Articles
        <a href="{{route('posts.create')}}" class="btn btn-sm btn-primary float-right btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus-square"></i>
            </span>
            <span class="text">Create</span>
        </a>
    </div>
    <div class="card-body">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <div style="overflow-x:auto;">
            <table style="width:100%" class="table table-striped">
                <thead>
                    <th>Id <i class="fas fa-sort-numeric-down"></i></th>
                    <th>Title</th>
                    <th>Updated_at</th>
                    <!-- TODO: Create a field that with a icon show that the post has image, embed content or nothing -->
                    <th style="min-width:125px" class="text-right">Actions</th>
                </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <td class="align-middle">{{$post->id}}</td>
                        <td>
                            <strong>{{$post->title}}</strong>
                            <br>
                            {{ $post->get_excerpt }}
                        </td>
                        <td class="align-middle">
                            {{ $post->updated_at->format('d M y') }}
                        </td>
                        <td class="text-right">
                            <!-- TODO: Add the show function and its view, function, etc-->
                            <a href="{{route('posts.edit', $post)}}" class="btn btn-secondary">
                                <i class="far fa-edit"></i>
                            </a>
                            <button form="delete" type="submit" class="btn btn-danger" onclick="return confirm('Are you sure to delete the post id {{$post->id}}')">
                                <i class="far fa-trash-alt"></i>
                            </button>
                            <form method="POST" action="{{route('posts.destroy', $post)}}" id="delete">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </table>
        {{ $posts->links() }}
    </div>
</div>
@endsection