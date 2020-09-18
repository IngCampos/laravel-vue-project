@extends('layouts.app_public')

@section('content')
<h3 class="col-12 text-center">Blog</h3>
<div class="row">
    @foreach($posts as $post)
    <div class="card bg-light col-md-6">
        <div class="card-body">
            @if ($post->image)
            <img src="{{ $post->get_image}}" alt="" class="card-img-top">
            @elseif($post->iframe)
            <div class="embed-responsive embed-responsive-16by9">
                {!! $post->iframe !!}
            </div>
            @endif
            <h5 class="card-title text-dark">{{ $post->title }}</h5>
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
</div>
{{ $posts->links() }}
@endsection