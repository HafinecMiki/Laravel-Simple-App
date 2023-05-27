<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialLoginController;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    if (Auth::check()) {
        return view('company.companies');
    } else {
        return view('login.login');
    }
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', function() { return view('login.login'); })->name('login');
    Route::get('/verify', function() { return view('login.confirm_code'); })->name('verify');
    Route::get('/register', function() { return view('login.register'); })->name('register');

    Route::get('sso/google', [SocialLoginController::class, 'redirectToProvider']);
    Route::get('sso/google/callback', [SocialLoginController::class, 'handleProviderCallback']);
});

Route::group(['middleware' => 'auth'], function () {
    // view company
    Route::get('/companies', function() { return view('company.companies'); });
    Route::get('/company-details/{company}', function() { return view('company.company_details'); });
    Route::get('/add-or-edit-company', function() { return view('company.create_or_edit_company'); });
    Route::get('/add-or-edit-company/{company}', function() { return view('company.create_or_edit_company'); });

    //logout
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});
