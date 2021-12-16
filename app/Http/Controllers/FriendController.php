<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function index()
    {
        $dataFriend = Friend::all();

        return view('friend', [
            'title' => 'Friend',
            'active' => 'friend',
            'friends' => $dataFriend
        ]);
    }

    public function addFriends(Request $request)
    {
        // dd(Friend::where('user_id', Auth::user()->id)->where('friend_id', User::where('username', $request->username)->first()->id)->first());
        // User not found in database
        if (!User::where('username', $request->username)->first()) {
            return redirect()->back()->with('error', 'Username was not found');
        }
        if (Auth::user()->username == $request->username) {
            return redirect()->back()->with('error', 'You can\'t add yourself as friend');
        }
        if (Friend::where('user_id', Auth::user()->id)->where('friend_id', User::where('username', $request->username)->first()->id)->first()) {
            return redirect()->back()->with('error', 'You are already friend with this user');
        }
    }
}
