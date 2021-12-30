<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::check()) {

            return view('profile', [
                'user' => auth()->user(),
                'active' => 'profile',
                'title' => 'Profile'
            ]);
        } else {
            return redirect('/login')->with('error', 'Please login or Register');
        }
    }

    public function changeProfile(Request $request)
    {
        if (!$request->photo) {
            if (!Hash::check($request->current_password, auth()->user()->password)) {
                return back()->with('error', 'Current password does not match!');
            } else {
                $request->validate([
                    'fullname' => 'required',
                    'current_password' => 'required|alpha_num|min:6',
                    'password' => 'required|alpha_num|min:6',
                    'confirm_password' => 'nullable|min:6|same:password',
                ]);

                User::find(auth()->user()->id)->update([
                    'fullname' => $request->fullname,
                    'password' => bcrypt($request->password),
                ]);

                return redirect()->back()->with('success', 'Change Password updated successfully');
            }
        }

        if ($request->photo) {
            $request->validate([
                'fullname' => 'required',
                'photo' => 'required|image|mimes:png,jpg|max:100024',
            ], [
                'photo.required' => 'Please upload a photo',
                'photo.image' => 'Please upload a valid image',
                'photo.mimes' => 'Profile extension must be jpg or png file',
                'photo.max' => 'Profile size must be less than 100 kilobytes',
            ]);

            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('profile'), $imageName);

            User::find(auth()->user()->id)->update([
                'fullname' => $request->fullname,
                'photo' => $imageName,
            ]);

            return redirect()->back()->with('success', 'Success updated photo profile successfully');
        }

        if ($request->password && $request->photo) {
            if (!Hash::check($request->current_password, auth()->user()->password)) {
                return back()->with('error', 'Current password does not match!');
            } else {
                $request->validate([
                    'fullname' => 'required',
                    'current_password' => 'required|alpha_num|min:6',
                    'password' => 'required|alpha_num|min:6',
                    'confirm_password' => 'nullable|min:6|same:password',
                    'photo' => 'required|image|mimes:png,jpg|max:100024',
                ], [
                    'photo.required' => 'Please upload a photo',
                    'photo.image' => 'Please upload a valid image',
                    'photo.mimes' => 'Profile extension must be jpg or png file',
                    'photo.max' => 'Profile size must be less than 100 kilobytes',
                ]);

                $imageName = time() . '.' . $request->photo->extension();
                $request->photo->move(public_path('profile'), $imageName);

                User::find(auth()->user()->id)->update([
                    'fullname' => $request->fullname,
                    'photo' => $imageName,
                    'password' => bcrypt($request->password),
                ]);

                return redirect()->back()->with('success', 'Profile updated successfully');
            }
        }

        return redirect()->back()->with('error', 'Something went wrong!');
    }
}
