<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class FollowingController extends Controller
{
    public function followUser($id){
        
        $user = User::find(auth()->user()->id);
        $userToFollow = User::find($id);
        
        if ($user->id !== $userToFollow->id) {
            $user->followings()->attach($userToFollow->id);
        }

        $isFollowing = $user->followings()->where('user_id', $userToFollow->id)->exists();

        return Inertia::render;
    }

}
