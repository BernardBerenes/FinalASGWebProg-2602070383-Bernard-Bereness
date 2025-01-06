<?php

namespace App\Http\Controllers;

use App\Models\Avatar;
use App\Models\AvatarTransaction;
use App\Models\Chat;
use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NavigationController extends Controller
{
    public function homePage()
    {
        if (Auth::check()){
            $user = User::where('id', '!=', Auth::user()->id)
                ->where('visibility', true)
                ->take(6)
                ->get();
        } else{
            $user = User::where('visibility', true)
                ->take(6)
                ->get();
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
                ->when($request->fields_of_work, function ($query) use ($request) {
                    return $query->where('fields_of_work', 'LIKE', '%'.$request->fields_of_work.'%');
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
                ->when($request->fields_of_work, function ($query) use ($request) {
                    return $query->where('fields_of_work', 'LIKE', '%'.$request->fields_of_work.'%');
                })
                ->when($request->name, function ($query) use ($request) {
                    return $query->where('name', 'LIKE', '%'.$request->name.'%');
                })
                ->where('visibility', true)
                ->get();
        }

        return view('pages.friend')->with('users', $users)->with('gender_filter', $request->gender)->with('fields_of_work_filter', $request->fields_of_work);
    }

    public function detailPage($user_id)
    {
        $user = User::findOrFail($user_id);

        return view('pages.detail', compact('user'));
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

        $avatars = Avatar::whereNotIn('id', $ownedAvatarIds)->paginate(9);

        return view('pages.avatar-market', compact('avatars'));
    }

    public function friendRequestPage()
    {
        $authUserId = Auth::user()->id;

        $includedUserIdsPending = Friend::where('receiver_id', $authUserId)
            ->where('status', 'Pending')
            ->pluck('sender_id');

        $pendingRequests = User::
            whereIn('id', $includedUserIdsPending)
            ->get();

        // $includedUserIdsAccepted = Friend::where('receiver_id', $authUserId)
        //     ->orWhere('sender_id', $authUserId)
        //     ->where('status', 'Accepted')
        //     ->pluck('sender_id');

        $includedUserIdsAccepted = Friend::where('sender_id', $authUserId)
            ->orWhere('receiver_id', $authUserId)
            ->where('status', 'Accepted')
            ->get(['sender_id', 'receiver_id'])
            ->flatMap(function ($friend) {
                return [$friend->sender_id, $friend->receiver_id];
            })
            ->unique()
            ->reject(fn($id) => $id == Auth::user()->id)
            ->toArray();

        $acceptedFriends = User::
            whereIn('id', $includedUserIdsAccepted)
            ->get();

        return view('pages.friend-request', compact('pendingRequests', 'acceptedFriends'));
    }

    public function chatPage($current_chat_id = null)
    {
        $chats = Chat::where('sender_id', Auth::user()->id)
            ->orWhere('receiver_id', Auth::user()->id)
            ->get();

        $userIds = $chats->pluck('sender_id')
            ->merge($chats->pluck('receiver_id'))
            ->unique()
            ->reject(fn($id) => $id == Auth::user()->id);

        $users = User::whereIn('id', $userIds)
            ->get();

        if (!$current_chat_id){
            $chats = null;
        } else{
            $chats = Chat::whereIn('sender_id', [$current_chat_id, Auth::user()->id])
                ->whereIn('receiver_id', [$current_chat_id, Auth::user()->id])
                ->get();

            if ($chats->isEmpty()){
                $currentUserChat = User::findOrFail($current_chat_id);
                $users->push($currentUserChat);
            } else{
                if ($chats[0]->receiver_id == Auth::user()->id){
                    foreach ($chats as $chat) {
                        $chat->seen = true;
                        $chat->save();
                    }
                }
            }
        }

        return view('pages.chat', compact('chats', 'users', 'current_chat_id'));
    }

    public function notificationPage()
    {
        $authUserId = Auth::user()->id;

        $chatNotification = Chat::where('receiver_id', $authUserId)
            ->where('seen', false)
            ->orderBy('created_at', 'desc')
            ->get();

        $includedUserIdsPending = Friend::where('receiver_id', $authUserId)
            ->where('status', 'Pending')
            ->pluck('sender_id');

        $friendRequestNotification = User::
            whereIn('id', $includedUserIdsPending)
            ->get();

        return view('pages.notification', compact('chatNotification', 'friendRequestNotification'));
    }
}