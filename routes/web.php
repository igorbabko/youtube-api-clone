<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
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
    return view('welcome');
});

Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');
Route::delete('/delete-account', [RegisteredUserController::class, 'destroy'])->middleware('auth');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('guest');
Route::delete('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth');
