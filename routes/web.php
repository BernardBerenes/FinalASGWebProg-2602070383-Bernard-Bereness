<?php

use App\Http\Controllers\AuthenthicationController;
use App\Http\Controllers\NavigationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('homePage');

Route::get('/login', [NavigationController::class, 'loginPage'])->name('loginPage');
Route::post('/login', [AuthenthicationController::class, 'login'])->name('login');

Route::get('/register', [NavigationController::class, 'registerPage'])->name('registerPage');
Route::post('/register', [AuthenthicationController::class, 'register'])->name('register');