<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class UserController extends Controller
{
    public function user()
    {
        $users = User::all();

        return Inertia::render('Admin/Main', [
            'users' => $users
        ]);
    }

    public function home(){
        $posts = Post::with('user')->latest()->get();
        return Inertia::render('User/Home', [
            'posts' => $posts
        ]);
    }

    public function test()
    {
        $users = User::all();

        return Inertia::render('Test/User', [
            'users' => $users
        ]);
    }

    public function profile(){
        return Inertia::render('User/Profile');
    }

    public function uploadImage(Request $request){

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $id = auth()->user()->id;
        $user = User::findOrFail($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users', 'public');
            $user->image = $imagePath;
        }

        $user->save();

        return redirect()->back()->with('success', 'User updated with image.');
    }

    public function createPost()
    {
      return Inertia::render('User/CreatePost');
    }

    public function uploadPost(Request $request)
    {
        $user_id = auth()->user()->id;

        $request->validate([
            'body' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'visibility' => 'required|string'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        }

        Post::create([
            'title' => '',
            'user_id' => $user_id,
            'body' => $request->body,
            'image' => $imagePath, // store relative path
            'visibility' => $request->visibility,
        ]);

        return redirect()->route('home')->with('success', 'Post Uploaded');
    }

}
