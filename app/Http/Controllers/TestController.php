<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TestController extends Controller
{
    public function create(){
        return Inertia::render('App');
    }

    public function submit(Request $request){

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        return Inertia::render('Home', [
            'success' => 'Created',
            'data' => $request->only('name', 'email', 'password')
        ]);
    }
}