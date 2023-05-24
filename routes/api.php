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

Route::group(['middleware' => 'guest'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login-request');
});
 
Route::group(['middleware' => 'auth'], function () {
    //functions company
    Route::post('/company-create', [CompanyController::class, 'store'])->name('company-create');
    Route::put('/company/{company}', [CompanyController::class, 'update'])->name('company-edit');
    Route::delete('/company/{company}', [CompanyController::class, 'delete'])->name('company-delete');
});
