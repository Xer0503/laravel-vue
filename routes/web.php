<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::get('/signin', [AuthController::class, 'signinPage'])->name('signin');
Route::post('/signin',  [AuthController::class, 'signin']);

Route::get('/signup', [AuthController::class, 'signupPage'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);

Route::get('/user', [UserController::class, 'user']);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [UserController::class, 'home'])->name('home');
});