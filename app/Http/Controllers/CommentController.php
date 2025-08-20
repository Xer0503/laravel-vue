<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class CommentController extends Controller
{
    public function comment(Request $request, $post_id)
    {
        $user = auth()->user();
        $request->validate([
            'body' => 'required|string'
        ]);

        Comment::create([
            'user_id' => $user->id,
            'post_id' => $post_id,
            'body' => $request->body,
        ]);

        return back();
    }
}
