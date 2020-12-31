@extends('layouts.app')

@section('title') Posts @endsection

@section('content')
    <div class="card col-12">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        <table-container>
            <template v-slot:head>
                <th>Id <i class="fas fa-sort-numeric-down"></i></th>
                <th>Title</th>
                <th>Updated_at</th>
                <!-- TODO: Create a field that with a icon show that the post has image, embed content or nothing -->
                <th style="min-width:125px" class="text-right">Actions</th>
            </template>
            <template v-slot:body>
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
                        <a href="{{route('posts.edit', $post)}}" class="btn btn-secondary btn-circle">
                            <i class="far fa-edit"></i>
                        </a>
                        <button form="delete" type="submit" class="btn btn-danger btn-circle" onclick="return confirm('Are you sure to delete the post id {{$post->id}}')">
                            <i class="far fa-trash-alt"></i>
                        </button>
                        <form method="POST" action="{{route('posts.destroy', $post)}}" id="delete">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </template>
            <template v-slot:footer>
                {{ $posts->links() }}
            </template>
        </table-container>
        <div class="form-group">
            <a href="{{route('posts.create')}}" class="btn btn-sm btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus-square"></i>
                </span>
                <span class="text">Create post</span>
            </a>
        </div>
    </div>
@endsection