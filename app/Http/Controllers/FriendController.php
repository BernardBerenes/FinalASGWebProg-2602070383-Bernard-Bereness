<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public static function addFriend($receiver_id)
    {
        Friend::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $receiver_id
        ]);

        return back();
    }
}
