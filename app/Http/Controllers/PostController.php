<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // Load posts with images
        $posts = Post::with('postImages')->latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        // Load images, comments, and replies
        $post->load([
            'postImages',
            'comments.replies' // eager load nested replies
        ]);

        return view('posts.show', compact('post'));
    }
}
