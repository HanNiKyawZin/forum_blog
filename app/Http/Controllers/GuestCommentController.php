<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class GuestCommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'guest_name' => 'required',
            'content' => 'required',
            'post_id' => 'required|exists:posts,id'
        ]);

        Comment::create([
            'guest_name' => $request->guest_name,
            'content' => $request->content,
            'post_id' => $request->post_id
        ]);

        return back()->with('success', 'Comment submitted successfully');
    }
}
