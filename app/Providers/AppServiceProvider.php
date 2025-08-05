<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use App\Models\Post;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $posts = Post::with('user')->latest()->get();
        Inertia::share([
            'auth' => function () {
                return [
                    'user' => auth()->user(),
                ];
            }
        ]);

        Inertia::share([
            'flash' => fn () => [
                'success' => session('success'),
                'error' => session('error')
            ]
        ]);

        Inertia::share([
            'posts' => fn () => [
                'post' => $posts,
            ]
        ]);

    }
}
