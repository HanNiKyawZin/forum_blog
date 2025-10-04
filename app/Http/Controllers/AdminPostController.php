<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::with('postImages')->latest()->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
                $post->postImages()->create(['image' => $filename]);
            }
        }

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    // ✅ Updated method for editing post with image removal
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'images.*' => 'image|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        // Update title and content
        $post->update([
            'title' => $request->title,
            'content' => $request->content
        ]);

        // Remove selected images
        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $img_id) {
                $image = $post->postImages()->find($img_id);
                if ($image) {
                    // Delete file from public/uploads
                    if (file_exists(public_path('uploads/' . $image->image))) {
                        unlink(public_path('uploads/' . $image->image));
                    }
                    $image->delete();
                }
            }
        }

        // Upload new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $filename);
                $post->postImages()->create(['image' => $filename]);
            }
        }

        return redirect()->route('admin.posts.edit', $post)->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        // Delete all images first
        foreach ($post->postImages as $img) {
            if (file_exists(public_path('uploads/' . $img->image))) {
                unlink(public_path('uploads/' . $img->image));
            }
            $img->delete();
        }

        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully!');
    }
}
