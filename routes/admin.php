<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Notification\FirebasePushNotificationController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('login-2', function () { // remove this route if you don't need it
    return inertia('admin.auth.login-2');
})->name('login-2');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
// push notification testing
Route::get('notification', [FirebasePushNotificationController::class, 'notification'])->name('notification');

// try to use filter on user 
Route::get('users', [UserController::class, 'index'])->name('users');

// custom channel for notification
Route::get('channel', [FirebasePushNotificationController::class, 'channel'])->name('notification.channel');

Route::post('login', [LoginController::class, 'login']);

Route::middleware(['auth'])->group(function () {
    Route::delete('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', function () {
        return inertia('admin.dashboard.index');
    })->name('dashboard');

    // insert record to activity_log via route
    Route::get('/create-order', [OrderController::class, 'create'])->name('create-order-static');
    Route::get('/update-status', [OrderController::class, 'updateStatus']);
    Route::get('/order-activity', [OrderController::class, 'orderActivity']);

    // remove this route if you don't need it
    require_once __DIR__ . '/component.php';
});
