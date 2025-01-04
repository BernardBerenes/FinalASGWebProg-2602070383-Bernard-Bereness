<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\AvatarTransaction;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NavigationController extends Controller
{
    public function homePage()
    {
        if (Auth::check()){
            $user = User::all();
        } else{
        }

        return view('pages.index')->with('users', $user);
    }

    public function friendPage(Request $request)
    {
        if (!Auth::check()){
            $users = User::
                when($request->gender, function ($query) use ($request) {
                    return $query->where('gender', $request->gender);
                })
                ->when($request->fields_of_interest, function ($query) use ($request) {
                    return $query->where('fields_of_interest', 'LIKE', '%'.$request->fields_of_interest.'%');
                })
                ->when($request->name, function ($query) use ($request) {
                    return $query->where('name', 'LIKE', '%'.$request->name.'%');
                })
                ->where('visibility', true)
                ->get();
        } else{
            $authUserId = Auth::user()->id;
            $excludedUserIds = Friend::where('sender_id', $authUserId)
                ->orWhere('receiver_id', $authUserId)
                ->get(['sender_id', 'receiver_id'])
                ->flatMap(function ($friend) {
                    return [$friend->sender_id, $friend->receiver_id];
                })
                ->push($authUserId)
                ->unique()
                ->toArray();

                $users = User::
                whereNotIn('id', $excludedUserIds)
                ->when($request->gender, function ($query) use ($request) {
                    return $query->where('gender', $request->gender);
                })
                ->when($request->fields_of_interest, function ($query) use ($request) {
                    return $query->where('fields_of_interest', 'LIKE', '%'.$request->fields_of_interest.'%');
                })
                ->when($request->name, function ($query) use ($request) {
                    return $query->where('name', 'LIKE', '%'.$request->name.'%');
                })
                ->where('visibility', true)
                ->get();
        }

        return view('pages.friend')->with('users', $users)->with('gender_filter', $request->gender)->with('fields_of_interest_filter', $request->fields_of_interest);
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

    public function myProfilePage()
    {
        $ownedAvatarIds = AvatarTransaction::where('buyer_id', Auth::user()->id)->pluck('avatar_id');

        $avatars = Avatar::whereIn('id', $ownedAvatarIds)->get();

        return view('pages.profile', compact('avatars'));
    }

    public function avatarMarketPage()
    {
        $ownedAvatarIds = AvatarTransaction::where('buyer_id', Auth::user()->id)->pluck('avatar_id');

        $avatars = Avatar::whereNotIn('id', $ownedAvatarIds)->paginate(6);

        return view('pages.avatar-market', compact('avatars'));
    }
}