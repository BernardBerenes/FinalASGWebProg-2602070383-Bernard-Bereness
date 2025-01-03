<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function homePage()
    {
        return view('index');
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
}
