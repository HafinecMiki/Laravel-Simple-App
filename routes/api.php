<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::post('/login', [AuthController::class, 'login'])->name('login-request');
        Route::post('/login2FA', [AuthController::class, 'login2FA'])->name('login2FA');
        Route::post('/verify-code/{user}', [AuthController::class, 'loginVerifyCode'])->name('verify-code');
        Route::post('/register', [AuthController::class, 'register'])->name('register-request');
    });

    Route::group(['middleware' => 'auth'], function () {
        //functions company
        Route::get('/companies-data', [CompanyController::class, 'index'])->name('companies-data');
        Route::get('/company/show-by-id/{id}', [CompanyController::class, 'showById'])->name('company-show-by-id');
        Route::post('/company-create', [CompanyController::class, 'store'])->name('company-create');
        Route::put('/company/{company}', [CompanyController::class, 'update'])->name('company-edit');
        Route::delete('/company/{company}', [CompanyController::class, 'delete'])->name('company-delete');

        //logout
        Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
