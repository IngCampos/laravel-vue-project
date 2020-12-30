@extends('layouts.public')

@section('title') Blog @endsection

@section('content')
<h3 class="col-12 text-center">Blog</h3>
<div class="row">
    @foreach($posts as $post)
    <div class="card shadow mb-4 bg-light col-md-6">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $post->title }}</h6>
        </div>
        <div class="card-body">
            @if ($post->image)
            <img src="{{ $post->get_image}}" alt="" class="card-img-top">
            @elseif($post->iframe)
            <div class="embed-responsive embed-responsive-16by9">
                {!! $post->iframe !!}
            </div>
            @endif
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