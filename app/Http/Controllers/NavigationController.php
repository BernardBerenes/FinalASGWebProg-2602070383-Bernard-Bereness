<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NavigationController extends Controller
{
    public function homePage()
    {
        if (Auth::check()){
            $user = Friend::with('sender_id', 'receiver_id')->get();
        } else{
            $user = User::all();
        }

        return view('pages.index')->with('users', $user);
    }

    public function friendPage()
    {
        if (Auth::check()){
            $authUserId = Auth::user()->id;
            // $excludedUserIds = array_merge($excludedUserIds, [Auth::user()->id]);
            $excludedUserIds = Friend::where('sender_id', $authUserId)
                ->orWhere('receiver_id', $authUserId)
                ->get(['sender_id', 'receiver_id'])
                ->flatMap(function ($friend) {
                    return [$friend->sender_id, $friend->receiver_id];
                })
                ->push($authUserId)
                ->unique()
                ->toArray();

            $users = User::whereNotIn('id', $excludedUserIds)->get();
        } else{
            $users = User::all();
        }

        return view('pages.friend')->with('users', $users);
    }

    public function registerPage()
    {
        if (session()->has('payment_expires')) {
            if (now()->greaterThan(session('payment_expires'))){
                session()->flush();
            }
        }

        return view('authenthication.register');
    }

    public function loginPage()
    {
        return view('authenthication.login');
    }

    public function topupPage()
    {
        return view('pages.top-up');
    }
}
