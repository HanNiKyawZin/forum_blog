<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('post', 'replies')
            ->whereNull('parent_id') // Only top-level
            ->orderBy('created_at', 'asc') // Oldest first
            ->get();

        return view('admin.comments.index', compact('comments'));
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }

    public function reply(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment->replies()->create([
            'post_id' => $comment->post_id,
            'guest_name' => 'Admin', // mark admin reply
            'content' => $request->content,
            'parent_id' => $comment->id,
            'is_read' => true,
        ]);

        return redirect()->back()->with('success', 'Reply added successfully!');
    }
}
