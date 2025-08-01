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
}
