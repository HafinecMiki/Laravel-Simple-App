<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
 
 
Route::get('/', [AuthController::class, 'checkLogin']);
 
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
 
Route::group(['middleware' => 'auth'], function () {
    // view company
    Route::get('/companies', [CompanyController::class, 'view']);
    Route::get('/company-details/{company}', [CompanyController::class, 'viewDetails']);
    Route::get('/add-or-edit-company', [CompanyController::class, 'viewAddNew']);
    Route::get('/add-or-edit-company/{company}', [CompanyController::class, 'viewAddNew']);
    //functions company
    Route::post('/company-create', [CompanyController::class, 'store'])->name('company-create');
    Route::put('/company/{company}', [CompanyController::class, 'update'])->name('company-edit');
    Route::delete('/company', [CompanyController::class, 'store']);

    //logout
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});