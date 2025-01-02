<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenthicationController extends Controller
{
    public function register(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'gender' => $request->gender,
            'fields_of_interest' => json_encode(explode(',', $request->fields_of_interest)),
            'linkedin_username' => $request->linkedin_username,
            'phone_number' => $request->phone_number,
        ]);

        return redirect(route('loginPage'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) return redirect(route('homePage'));

        return back();
    }

    public function logout(Request $request)
    {

    }
}
