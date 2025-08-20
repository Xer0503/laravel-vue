<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Post;
use App\Models\Reaction;

class PostController extends Controller
{
    public function post(){
        $posts = Post::with(['user', 'reactions', 'comments'])->latest()->get();
        return Inertia::render('/User/Home',[
            'posts' => $posts
        ]);
    }

    public function deletePost($id){
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->back()->with('success', 'post has been deleted!');
    }

    public function react(Request $request, $id)
    {
        $userId = auth()->id();

        $request->validate([
            'type' => 'required|string|in:like,love,haha,sad,angry'
        ]);

        // Check if the user already reacted to this post
        $reaction = Reaction::where('user_id', $userId)
                            ->where('post_id', $id)
                            ->first();

        if ($reaction) {
            $reaction->update([
                'type' => $request->type
            ]);
        } else {
            Reaction::create([
                'user_id' => $userId,
                'post_id' => $id,
                'type' => $request->type
            ]);
        }

        return back();
    }

}
