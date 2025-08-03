<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard() {
        return Inertia::render('Admin/Dashboard');
    }

    public function user() {
        $users = User::all();
        return Inertia::render('Admin/User', [
            'users' => $users
        ]);
    }

    public function post() {
        return Inertia::render('Admin/Post');
    }

    public function deleteUser($id) {
        $user = User::findOrFail($id);
        if($id != auth()->user()->id){
            $user->delete();
            return redirect()->route('admin.user')->with('success', 'User deleted.');
        }
        return redirect()->back()->with('success', 'User deleted.');
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password != ''){
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return back()->with('success', 'User updated.');
    }
}
