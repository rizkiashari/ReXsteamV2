<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('signup', [
            'title' => "Register",
            'active' => 'register',
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        $validasiData =  $request->validate([
            'role_id' => ['required'],
            'username' => ['required', 'unique:users', 'min:6'],
            'fullname' => ['required'],
            'password' => 'required|alpha_num|min:6',
        ], [
            'username.required' => 'Username must be filled.',
            'username.unique' => 'Username already exists.',
            'username.min' => 'Username must be at least 6 characters.',
            'fullname.required' => 'Fullname must be filled.',
            'password.required' => 'Password must be filled.',
            'password.alpha_num' => 'Password must contains alpha numeric.',
            'password.min' => 'Password must be at least 6 characters.',
            'role_id.required' => 'Role must be filled.'
        ]);

        $validasiData['password'] = bcrypt($validasiData['password']);

        $user = User::create($validasiData);

        Auth::login($user);

        return redirect('/')->with('success', 'Successfully Registrasion Account.');
    }
}
