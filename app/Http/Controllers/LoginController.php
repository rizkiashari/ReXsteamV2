<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

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


        if (Auth::attempt($credentials)) {
            $remember_me = (!empty($request->remember_me)) ? true : false;
            $request->session()->regenerate();

            $user = User::where(["username" => $credentials['username']])->first();
            Auth::login($user, $remember_me);
            Cookie::queue(Auth::getRecallerName(), Cookie::get(Auth::getRecallerName()), 60 * 60 * 2);
            // if (Cookie::get(Auth::getRecallerName())) {
            //     return redirect('/');
            // } else {
            //     return redirect('/login');
            // }
            return redirect('/')->with('success', 'You are now logged in');
        }

        return back()->withErrors([
            'username' => 'Invalid user credentials.',
            'password' => 'Invalid user credentials.'
        ]);
    }

    public function logout()
    {
        Auth::logoutCurrentDevice();
        request()->session()->invalidate();
        Cookie::queue(Cookie::forget(Auth::getRecallerName()));
        request()->session()->regenerateToken();

        return redirect('/login');
    }
}
