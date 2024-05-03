<?php

use App\Http\Controllers\Admin\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return inertia('welcome');
});

Route::get('/export-view', [UserController::class, 'exportByView']);
Route::get('/export-query', [UserController::class, 'exportByQuery']);
Route::get('/export-collection', [UserController::class, 'exportByCollection']);
