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
        // User not found in database
        if (!User::where('username', $request->username)->first()) {
            return redirect()->back()->with('error', 'User not found');
        }

    }
}
