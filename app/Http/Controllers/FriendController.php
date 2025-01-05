<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    public function addFriend($receiver_id)
    {
        Friend::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $receiver_id
        ]);

        return back();
    }

    public function acceptFriend($sender_id)
    {
        Friend::where('sender_id', $sender_id)
            ->where('receiver_id', Auth::user()->id)
            ->update([
                'status' => 'Accepted'
            ]);

        return back();
    }

    public function rejectFriend($sender_id)
    {
        Friend::where('sender_id', $sender_id)
            ->where('receiver_id', Auth::user()->id)
            ->delete();

        return back();
    }
}
