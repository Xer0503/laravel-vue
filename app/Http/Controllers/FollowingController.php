<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowingController extends Controller
{
    public function followUser($id)
    {
        $user = auth()->user();
        $userToFollow = User::findOrFail($id);

        // Prevent following self and avoid duplicates
        if ($user->id !== $userToFollow->id && !$user->followings()->where('users.id', $id)->exists()) {
            $user->followings()->attach($id);
        }

        return redirect()->back();
    }

    public function unfollowUser($id)
    {
        $user = auth()->user();
        $userToUnfollow = User::findOrFail($id);

        // Prevent unfollowing self
        if ($user->id !== $userToUnfollow->id && $user->followings()->where('users.id', $id)->exists()) {
            $user->followings()->detach($id);
        }

        return redirect()->back();
    }
}
