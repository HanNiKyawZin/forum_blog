@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="container">
    <!-- Back Button -->
    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary mb-3">← Back to Posts List</a>

    <!-- Post Details -->
    <div class="card mb-4">
        <div class="card-body">
            <h3>{{ $post->title }}</h3>
            <p>{{ $post->content }}</p>
            @if($post->postImages->count() > 0)
                <div class="row g-2">
                    @foreach($post->postImages as $img)
                        <div class="col-6 col-sm-4 col-md-3">
                            <img src="{{ asset('uploads/'.$img->image) }}" class="img-fluid rounded">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Comments Section -->
    <h4>Comments</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($post->comments()->whereNull('parent_id')->orderBy('created_at','asc')->get() as $comment)
        <div class="card mb-2 p-2">
            <strong>{{ $comment->guest_name }}</strong>: {{ $comment->content }}

            <!-- Admin Delete for original comment -->
            @auth
                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="d-inline float-end ms-2">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this comment?')">Delete</button>
                </form>
            @endauth

            <!-- Replies -->
            @foreach($comment->replies()->orderBy('created_at','asc')->get() as $reply)
                <div class="card mt-2 p-2 ms-3">
                    <strong>{{ $reply->guest_name }}</strong>: {{ $reply->content }}

                    <!-- Admin Delete for reply -->
                    @auth
                        <form action="{{ route('admin.comments.destroy', $reply->id) }}" method="POST" class="d-inline float-end ms-2">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this reply?')">Delete</button>
                        </form>
                    @endauth
                </div>
            @endforeach

            <!-- Admin Reply Form -->
            @auth
                <form action="{{ route('admin.comments.reply', $comment->id) }}" method="POST" class="mt-1 ms-3">
                    @csrf
                    <textarea name="content" class="form-control mb-1" rows="1" placeholder="Write a reply..." style="resize: vertical; height: 28px; font-size: 0.8rem; padding: 3px;"></textarea>
                    <button class="btn btn-primary btn-sm">Reply</button>
                </form>
            @endauth
        </div>
    @empty
        <p>No comments yet.</p>
    @endforelse

    <!-- Guest Comment Form -->
    <h5 class="mt-4">Add a Comment</h5>
    <form action="{{ route('guest.comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div class="mb-2">
            <input type="text" name="guest_name" class="form-control" placeholder="Your name" required style="font-size:0.85rem; padding:4px;">
        </div>
        <div class="mb-2">
           <textarea name="content" class="form-control mb-1" rows="1" placeholder="Write a comment..." style="resize: vertical; height: 28px; font-size: 0.85rem; padding: 3px;"></textarea>
        </div>
        <button class="btn btn-success btn-sm">Submit Comment</button>
    </form>
</div>
@endsection
