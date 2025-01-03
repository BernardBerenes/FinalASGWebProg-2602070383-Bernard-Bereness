<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenthicationController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|unique:users,email|email',
            'password' => 'required|regex:/[0-9]/|regex:/[a-z]/|regex:/[A-Z]/|regex:/[@$!%*?&#]/',
            'gender' => 'required',
            'fields_of_interest' => 'required|regex:/^(?:[a-zA-Z\s]+,){2,}[a-zA-Z\s]+$/',
            'linkedin_username' => 'required|regex:/^https:\/\/www.linkedin\.com\/in\/[a-zA-Z0-9\-_]+$/',
            'phone_number' => 'required|digits:12'
        ], [
            'name.required' => __('validation.name_required'),
            'name.min' => __('validation.name_min'),
            'email.required' => __('validation.email_required'),
            'email.unique' => __('validation.email_unique'),
            'email.email' => __('validation.email'),
            'password.required' => __('validation.password_required'),
            'password.regex:/[0-9]/' => __('validation.password_digit'),
            'password.regex:/[a-z]/' => __('validation.password_lowercase'),
            'password.regex:/[A-Z]/' => __('validation.password_uppercase'),
            'password.regex:/[@$!%*?&#]/' => __('validation.password_special'),
            'gender.required' => __('validation.gender_required'),
            'fields_of_interest.required' => __('validation.fields_of_interest_required'),
            'fields_of_interest.regex' => __('validation.fields_of_interest_regex'),
            'linkedin_username.required' => __('validation.linkedin_username_required'),
            'linkedin_username.regex' => __('validation.linkedin_username_regex'),
            'phone_number.required' => __('validation.phone_number_required'),
            'phone_number.digits' => __('validation.phone_number_digit')
        ]);

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
        ], [
            'email.required' => __('validation.email_required'),
            'email.email' => __('validation.email'),
            'password.required' => __('validation.password_required')
        ]);

        if (Auth::attempt($credentials)) return redirect(route('homePage'));

        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back();
    }
}
