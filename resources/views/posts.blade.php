@extends('layouts.app_public')

@section('content')

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

@endsection