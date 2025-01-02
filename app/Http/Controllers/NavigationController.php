<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function registerPage()
    {
        return view('authenthication.register');
    }

    public function loginPage()
    {
        return view('authenthication.login');
    }
}
