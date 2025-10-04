@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>

    <h3 class="mt-4">Images</h3>
    <div class="row mb-4">
        @foreach($post->postImages as $img)
        <div class="col-md-3 mb-2">
            <img src="{{ asset('uploads/'.$img->image) }}" class="img-fluid rounded">
        </div>
        @endforeach
    </div>

    <h3 class="mt-4">Comments</h3>
    @foreach($post->comments as $comment)
    <p><strong>{{ $comment->guest_name }}:</strong> {{ $comment->content }}</p>
    @endforeach

    <h4 class="mt-4">Add Comment</h4>
    <form action="{{ route('guest.comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div class="mb-3">
            <input type="text" name="guest_name" class="form-control" placeholder="Your Name" required>
        </div>
        <div class="mb-3">
            <textarea name="content" class="form-control" placeholder="Comment" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Comment</button>
    </form>
</div>
@endsection
