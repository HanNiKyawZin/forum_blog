@extends('layouts.admin')

@section('title', 'Reply to Comment')

@section('content')
<div class="container">
    <h2>Reply to Comment #{{ $comment->id }}</h2>
    <p><strong>Post:</strong> {{ $comment->post->title }}</p>
    <p><strong>Comment by {{ $comment->guest_name }}:</strong> {{ $comment->content }}</p>

    <form action="{{ route('admin.comments.storeReply', $comment->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="content" class="form-label">Your Reply</label>
            <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Reply</button>
        <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
