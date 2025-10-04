@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="container">
    <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary mb-3">Back to Posts</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $post->title }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="5">{{ $post->content }}</textarea>
        </div>

        <div class="mb-3">
            <label>Existing Images:</label><br>
            @foreach($post->postImages as $img)
                <div class="d-inline-block position-relative me-2 mb-2">
                    <img src="{{ asset('uploads/'.$img->image) }}" style="width:150px; height:auto;">
                    <div>
                        <input type="checkbox" name="remove_images[]" value="{{ $img->id }}"> Remove
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mb-3">
            <label>Upload New Images:</label>
            <input type="file" name="images[]" multiple class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>
@endsection
