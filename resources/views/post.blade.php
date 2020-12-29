@extends('layouts.public')

@section('content')

<div class="card mb-4">
    @if ($post->image)
    <img src="{{ $post->get_image}}" alt="" class="card-img-top">
    @endif
    <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        @if($post->iframe)
        <div class="embed-responsive embed-responsive-16by9">
            {!! $post->iframe !!}
        </div>
        @endif
        <p class="card-text">{{ $post->body }}</p>
        <p class="text-muted mb-0">
            <em>
                &ndash; {{ $post->user->name }}
            </em>
            {{ $post->created_at->format('d M y') }}
        </p>
    </div>
</div>

@endsection