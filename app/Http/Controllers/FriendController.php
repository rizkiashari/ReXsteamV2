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
        if (Auth::check()) {
            if (Auth::user()->role_id == 2) {
                $friendsIncoming = Friend::where('friend_id', Auth::id())
                    ->where('status_user', 'Incoming')
                    ->join('users', 'users.id', '=', 'friends.user_id')->join('roles', 'roles.id', '=', 'users.role_id')
                    ->select('users.id', 'users.fullname', 'users.photo as profile', 'roles.name as role', 'friends.status_user', 'users.level', 'friends.id as idParent')->get();

                $friendsPending = Friend::where('user_id', Auth::id())
                    ->where('status_friend', 'Pending')
                    ->join('users', 'users.id', '=', 'friends.friend_id')->join('roles', 'roles.id', '=', 'users.role_id')
                    ->select('users.id', 'users.fullname', 'users.photo as profile', 'roles.name as role', 'friends.status_friend', 'users.level', 'friends.id as idParent')->get();

                $friendsSuccess = Friend::where('user_id', Auth::id())
                    ->where('status_friend', 'Success')
                    ->join('users', 'users.id', '=', 'friends.friend_id')->join('roles', 'roles.id', '=', 'users.role_id')
                    ->select('users.id', 'users.fullname', 'users.photo as profile', 'roles.name as role', 'friends.status_friend', 'status_user', 'users.level')->get();
                $usersSuccess = Friend::where('friend_id', Auth::id())
                    ->where('status_user', 'Success')
                    ->join('users', 'users.id', '=', 'friends.user_id')->join('roles', 'roles.id', '=', 'users.role_id')
                    ->select('users.id', 'users.fullname', 'users.photo as profile', 'roles.name as role', 'friends.status_friend', 'status_user', 'users.level')->get();

                return view('friend', [
                    'title' => 'Friend',
                    'active' => 'friend',
                    'friendsIncoming' => $friendsIncoming,
                    'friendsPending' => $friendsPending,
                    'friendsSuccess' => $friendsSuccess,
                    'usersSuccess' => $usersSuccess,
                ]);
            }
        } else {
            return redirect('/login')->with('error', 'Please login or Register');
        }
    }

    public function addFriends(Request $request)
    {
        if (!User::where('username', $request->username)->first()) {
            return redirect()->back()->with('error', 'Username was not found');
        }

        if (Auth::user()->username == $request->username) {
            return redirect()->back()->with('error', 'You can\'t add yourself as friend');
        }

        if (Friend::where('user_id', Auth::user()->id)->where('friend_id', User::where('username', $request->username)->first()->id)->first()) {
            return redirect()->back()->with('error', 'Username is already on the friend request or friend list');
        }

        if (Friend::where('user_id', User::where('username', $request->username)->first()->id)->where('friend_id', Auth::user()->id)->first()) {
            return redirect()->back()->with('error', 'This username already added you as friend');
        }

        $friend = new Friend;
        $friend->user_id = Auth::user()->id;
        $friend->status_user = "Incoming";
        $friend->status_friend = "Pending";
        $friend->friend_id = User::where('username', $request->username)->first()->id;
        $friend->save();

        return redirect()->back()->with('success', 'You have added ' . $request->username . ' as friend');
    }

    public function cancelStatus(Friend $friend)
    {
        $friend->delete();
        return redirect()->back()->with('success', 'You have canceled your friend request');
    }

    public function rejectStatus(Friend $friend)
    {
        $friend->delete();
        return redirect()->back()->with('success', 'You have rejected your friend request');
    }

    public function acceptStatus(Friend $friend)
    {
        $friend->status_user = "Success";
        $friend->status_friend = "Success";
        $friend->save();
        return redirect()->back()->with('success', 'You have successfully accepted your friend request');
    }
}
