<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Post;

class PostController extends Controller
{
    public function post(){
        $posts = Post::all();

        return Inertia::render('/User/Home',[
            'posts' => $posts
        ]);
    }

    public function deletePost($id){
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('profile')->with('success', 'post has been deleted!');
    }
}
