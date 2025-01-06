<?php

use App\Http\Controllers\AuthenthicationController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [NavigationController::class, 'homePage'])->name('homePage');
Route::get('/friend', [NavigationController::class, 'friendPage'])->name('friendPage');
Route::get('/detail/{user_id}/', [NavigationController::class, 'detailPage'])->name('detailPage');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [NavigationController::class, 'loginPage'])->name('loginPage');
    Route::post('/login', [AuthenthicationController::class, 'login'])->name('login');
    
    Route::get('/register', [NavigationController::class, 'registerPage'])->name('registerPage');
    Route::post('/register', [AuthenthicationController::class, 'register'])->name('register');
    
    Route::post('/payment', [AuthenthicationController::class, 'payment'])->name('payment');
    Route::post('/overpaid-payment', [AuthenthicationController::class, 'overpaidPayment'])->name('overpaidPayment');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/add-friend/{receiver_id}', [FriendController::class, 'addFriend'])->name('addFriend');
    
    Route::get('/top-up', [NavigationController::class, 'topupPage'])->name('topupPage');
    Route::post('/top-up', [CoinController::class, 'topup'])->name('topup');
    
    Route::post('/logout', [AuthenthicationController::class, 'logout'])->name('logout');
    
    Route::get('/my-profile', [NavigationController::class, 'myProfilePage'])->name('myProfilePage');
    
    Route::post('/change-visibility', [UserController::class, 'changeVisibility'])->name('changeVisibility');
    
    Route::get('/avatar-market', [NavigationController::class, 'avatarMarketPage'])->name('avatarMarketPage');
    Route::post('/purchase-avatar/{avatar_id}', [AvatarController::class, 'purchaseAvatar'])->name('purchaseAvatar');
    Route::post('/change-avatar', [UserController::class, 'changeAvatar'])->name('changeAvatar');
    
    Route::get('/friend-request', [NavigationController::class, 'friendRequestPage'])->name('friendRequestPage');
    Route::post('/accept-friend/{sender_id}', [FriendController::class, 'acceptFriend'])->name('acceptFriend');
    Route::post('/reject-friend/{sender_id}', [FriendController::class, 'rejectFriend'])->name('rejectFriend');

    Route::get('/chat/{current_chat_id?}', [NavigationController::class, 'chatPage'])->name('chatPage');
    Route::post('/send-message/{receiver_id}', [ChatController::class, 'sendMessage'])->name('sendMessage');
});

Route::get('/set-locale/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('set-locale');