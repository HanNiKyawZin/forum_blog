@extends('layouts.app')

@section('content')
<h1>Posts</h1>
@foreach($posts as $post)
<div class="card mb-3">
    <div class="card-body">
        <h5 class="card-title">{{ $post->title }}</h5>
        <p>{{ Str::limit($post->content, 150) }}</p>
        <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Read More</a>
    </div>
</div>
@endforeach
{{ $posts->links() }}
@endsection
