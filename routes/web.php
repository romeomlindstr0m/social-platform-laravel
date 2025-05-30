<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use Illuminate\Http\Request;

Route::get('/register', [AuthenticationController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthenticationController::class, 'register'])->name('register.submit');

Route::get('/login', [AuthenticationController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthenticationController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::redirect('/', '/home');

Route::get('/email/verify', function () {
    return view('verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('verification_sent', 'Verification link sent!');
})->middleware('auth')->name('verification.send');