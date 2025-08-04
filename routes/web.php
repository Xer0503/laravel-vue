<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/signin', [AuthController::class, 'signinPage'])->name('signin');
Route::post('/signin',  [AuthController::class, 'signin']);

Route::get('/signinAdmin', [AuthController::class, 'signinPageAdmin'])->name('admin.signin');
Route::post('/signinAdmin',  [AuthController::class, 'signinAdmin']);

Route::get('/signup', [AuthController::class, 'signupPage'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);

Route::get('/user', [UserController::class, 'test']);
Route::post('/user/update/{id}', [AdminController::class, 'update']);

//For User Controller route
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [UserController::class, 'home'])->name('home');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile/changeProfile', [UserController::class, 'uploadImage'])->name('changeProfile');
    Route::get('/createPost',[UserController::class, 'createPost'])->name('createPost');
    Route::post('/uploadPost',[UserController::class, 'uploadPost'])->name('uploadPost');
});


//For Admin COntroller route
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/user', [AdminController::class, 'user'])->name('admin.user');
    Route::get('/post', [AdminController::class, 'post'])->name('admin.post');

    Route::delete('/user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::patch('/user/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');