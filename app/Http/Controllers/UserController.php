<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function changeVisibility()
    {
        User::findOrFail(Auth::user()->id)->update([
            'visibility' => !Auth::user()->visibility
        ]);

        return back();
    }

    public function changeAvatar(Request $request)
    {
        User::findOrFail(Auth::user()->id)->update([
            'profile_picture' => $request->avatar_path
        ]);

        return back();
    }
}
