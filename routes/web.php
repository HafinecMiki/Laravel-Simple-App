<?php

use App\Http\Controllers\RouterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialLoginController;


Route::get('/', [RouterController::class, 'checkMainRoute']);

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [RouterController::class, 'showLogin'])->name('login');
    Route::get('/verify/{user}', [RouterController::class, 'showVerify'])->name('verify');
    Route::get('/register', [RouterController::class, 'showRegister'])->name('register');

    //sso
    Route::get('sso/google', [SocialLoginController::class, 'redirectToProvider'])->name('sso-google');
    Route::get('sso/google/callback', [SocialLoginController::class, 'handleProviderCallback'])->name('sso-google-callback');
});

Route::group(['middleware' => 'auth'], function () {
    // company
    Route::get('/companies', [RouterController::class, 'showCompanies'])->name('companies');
    Route::get('/company-details/{company}', [RouterController::class, 'showCompanyDetails'])->name('company-details');
    Route::get('/add-or-edit-company', [RouterController::class, 'showCompanyCreate'])->name('company-create-page');
    Route::get('/add-or-edit-company/{company}', [RouterController::class, 'showCompanyEdit'])->name('company-edit-page');
});
