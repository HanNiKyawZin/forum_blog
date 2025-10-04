<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['post_id', 'guest_name', 'content', 'parent_id', 'is_read'];

    // Replies for this comment
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id')->orderBy('created_at', 'asc');
        return $this->hasMany(Comment::class, 'parent_id')->with('replies');
    }

    // Parent comment
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Related post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
}

