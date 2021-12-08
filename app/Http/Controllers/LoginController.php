<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view("signin", [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ]);

        $remember_me = (!empty($request->remember_me)) ? true : false;

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = User::where(["username" => $credentials['username']])->first();
            Auth::login($user, $remember_me);
            return redirect('/')->with('success', 'You are now logged in');
        }

        return back()->withErrors([
            'username' => 'Invalid user credentials.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
