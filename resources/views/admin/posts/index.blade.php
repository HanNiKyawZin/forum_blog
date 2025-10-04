@extends('layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('title', 'Posts List')

@section('content')
<div class="container">
    <h2>Posts List</h2>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-success mb-3">Create Post</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Images</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td>{{ Str::limit($post->content, 100) }}</td>
                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                @foreach ($post->postImages as $img)
                                    <img src="{{ asset('uploads/'.$img->image) }}" class="img-fluid" style="max-width:100px; height:auto;">
                                @endforeach
                            </div>
                        </td>
                        <td class="d-flex flex-column gap-1">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                            <a href="{{ route('admin.posts.show', $post) }}" class="btn btn-info btn-sm">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No posts yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
