<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ResellerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login');

Route::middleware(['guest'])->group(function() {
    Route::controller(UserController::class)->group(function() {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate')->name('login.authenticate');
    });
});

Route::middleware(['auth'])->group(function() {
    Route::controller(UserController::class)->group(function() {
        Route::post('/logout', 'logout')->name('logout');
    });

    Route::controller(DashboardController::class)->group(function() {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    Route::controller(StaffController::class)->group(function() {
        Route::get('/staff', 'index')->name('staff');
        Route::get('/staff/detail/{id}', 'detail')->name('staff.detail');
        Route::get('/staff/add', 'create')->name('staff.create');
        Route::post('/staff/add', 'store')->name('staff.store');
        Route::get('/staff/edit/{id}', 'edit')->name('staff.edit');
        Route::post('/staff/edit/{id}', 'update')->name('staff.update');
        Route::post('/staff/delete/{id}', 'delete')->name('staff.delete');
    });
});