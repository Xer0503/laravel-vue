<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Inertia::share([
            // Share authenticated user
            'auth' => fn () => [
                'user' => Auth::user(),
            ],

            // Flash messages (success/error)
            'flash' => fn () => [
                'success' => session('success'),
                'error' => session('error'),
            ],
            // Only share followers/followings of the logged-in user
            'followers' => fn () => Auth::check()
                ? Auth::user()->followers()
                ->select('users.id', 'users.name', 'users.image')
                ->get()
                : [],

            'followings' => fn () => Auth::check()
                ? Auth::user()->followings()
                ->select('users.id', 'users.name', 'users.image')
                ->get()
                : [],
        ]);
    }
}