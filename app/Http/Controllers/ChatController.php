<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function sendMessage(Request $request, $receiver_id)
    {
        $request->validate([
            'message' => 'required'
        ], [
            'message.required' => __('validation.message_required')
        ]);

        Chat::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $receiver_id,
            'message' => $request->message
        ]);

        return back();
    }
}
