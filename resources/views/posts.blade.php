@extends('layouts.app_public')

@section('content')
<h3 class="col-12 text-center">Blog</h3>
<div class="col-md-8">
    @foreach($posts as $post)
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">
                {{ $post->get_excerpt }}
                <a href="{{route('blog', $post)}}">Read more</a>
            </p>
            <p class="text-muted mb-0">
                <em>
                    &ndash; {{ $post->user->name }}
                </em>
                {{ $post->created_at->format('d M y') }}
            </p>
        </div>
    </div>
    @endforeach
    {{ $posts->links() }}
</div>
@endsection