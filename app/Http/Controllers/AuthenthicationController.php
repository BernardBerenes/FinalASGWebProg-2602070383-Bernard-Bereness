<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenthicationController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
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

        session([
            'user_data' => $validated,
            'registration_fee' => rand(100000, 125000),
            'payment' => true,
            'payment_expires' => now()->addSecond(60)
        ]);

        return back()->withInput();
    }

    public function payment(Request $request)
    {
        if ($request->amount == session('registration_fee')){
            $user_data = session('user_data');
            User::create([
                'name' => $user_data['name'],
                'email' => $user_data['email'],
                'password' => $user_data['password'],
                'gender' => $user_data['gender'],
                'fields_of_interest' => json_encode(explode(',', $user_data['fields_of_interest'])),
                'linkedin_username' => $user_data['linkedin_username'],
                'phone_number' => $user_data['phone_number']
            ]);

            session()->flush();

            return redirect(route('loginPage'))->with('success', __('lang.registration_success'));
        } else if ($request->amount < session('registration_fee')){
            return back()->withErrors(['amount' => __('lang.underpaid', ['amount' => session('registration_fee') - $request->amount])]);
        } else{
            session([
                'overpaid' => $request->amount - session('registration_fee') 
            ]);

            return back();
        }
    }

    public function overpaidPayment()
    {
        $user_data = session('user_data');
        User::create([
            'name' => $user_data['name'],
            'email' => $user_data['email'],
            'password' => $user_data['password'],
            'gender' => $user_data['gender'],
            'fields_of_interest' => json_encode(explode(',', $user_data['fields_of_interest'])),
            'linkedin_username' => $user_data['linkedin_username'],
            'phone_number' => $user_data['phone_number'],
            'coin' => session('overpaid')
        ]);

        session()->flush();

        return redirect(route('loginPage'))->with('success', __('lang.registration_success'));
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

        return back()->withErrors(['password' => __('lang.invalid_credentials')]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back();
    }
}
