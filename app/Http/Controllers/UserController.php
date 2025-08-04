<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\User;

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
        return Inertia::render('User/Home');
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
}
