<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\TestController;

Route::get('/',  [TestController::class, 'create'])->name('home');
Route::post('/home',  [TestController::class, 'submit'])->name('submit');
Route::get('/home',  [TestController::class, 'create'])->name('create');