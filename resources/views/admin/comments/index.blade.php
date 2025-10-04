@extends('layouts.app')

@section('title', 'Comments List')

@section('content')
<div class="container">
    <!-- Back Button -->
    <div class="mb-3">
        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">← Back to Post List</a>
    </div>

    <h2 class="mb-3">Comments List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Post Title</th>
                    <th>Guest Name</th>
                    <th>Comment & Replies</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>{{ $comment->post->title }}</td>
                        <td>{{ $comment->guest_name }}</td>
                        <td>
                            <!-- Original Comment -->
                            <div class="mb-2 p-2 border rounded">
                                <strong>{{ $comment->guest_name }}:</strong> {{ $comment->content }}

                                <!-- Delete original comment -->
                                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="d-inline float-end ms-2">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this comment?')">Delete</button>
                                </form>
                            </div>

                            <!-- Replies -->
                            @foreach($comment->replies()->orderBy('created_at','asc')->get() as $reply)
                                <div class="ms-4 mb-1 p-2 border rounded">
                                    <strong>{{ $reply->guest_name }}:</strong> {{ $reply->content }}
                                    <!-- Delete reply -->
                                    <form action="{{ route('admin.comments.destroy', $reply->id) }}" method="POST" class="d-inline float-end ms-2">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this reply?')">Delete</button>
                                    </form>
                                </div>
                            @endforeach

                            <!-- Admin Reply Form Inline -->
                            <form action="{{ route('admin.comments.reply', $comment->id) }}" method="POST" class="d-flex mt-1 ms-4">
                                @csrf
                                <input type="text" name="content" class="form-control me-2" placeholder="Write a reply..." style="height: 30px; font-size: 0.85rem; padding: 2px;">
                                <button class="btn btn-primary btn-sm">Reply</button>
                            </form>
                        </td>
                        <td>
                            <!-- Additional actions could go here -->
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">No comments yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
