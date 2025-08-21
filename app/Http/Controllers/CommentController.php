<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function comment(Request $request, $id)
    {
        $userId = auth()->id();

        $request->validate([
            'body' => 'required|string'
        ]);

        $comment = Comment::create([
            'user_id' => $userId,
            'post_id' => $id,
            'body' => $request->body
        ]);
        $comment->load('user');
        return back();
    }

}
