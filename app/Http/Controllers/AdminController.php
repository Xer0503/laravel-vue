<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\User;

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
}
