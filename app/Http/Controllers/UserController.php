<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('profile', [
            'user' => auth()->user(),
            'active' => 'profile',
            'title' => 'Profile'
        ]);
    }
}
