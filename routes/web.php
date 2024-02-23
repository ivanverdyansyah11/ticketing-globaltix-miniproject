<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileCustomerController;
use App\Http\Controllers\ProfileStaffController;
use App\Http\Controllers\RegionCategoryController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TicketCategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TourGuideController;
use App\Http\Controllers\TouristSiteController;
use App\Http\Controllers\TouristSiteFacilityController;
use App\Http\Controllers\TransactionController;
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

Route::fallback(function() {
    return redirect('/');
});

Route::redirect('/', '/login');

Route::middleware(['guest'])->group(function() {
    Route::controller(UserController::class)->group(function() {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate')->name('login.authenticate');
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'store')->name('register.store');
    });
});

Route::middleware(['auth'])->group(function() {
    Route::controller(UserController::class)->group(function() {
        Route::post('/logout', 'logout')->name('logout');
    });
    
    Route::controller(DashboardController::class)->group(function() {
        Route::get('/dashboard', 'index')->name('dashboard');
    });


    Route::controller(AdminController::class)->group(function() {
        Route::get('/admin', 'index')->name('admin');
        Route::get('/admin/detail/{id}', 'detail')->name('admin.detail');
        Route::get('/admin/add', 'create')->name('admin.create');
        Route::post('/admin/add', 'store')->name('admin.store');
        Route::get('/admin/edit/{id}', 'edit')->name('admin.edit');
        Route::post('/admin/edit/{id}', 'update')->name('admin.update');
        Route::post('/admin/delete/{id}', 'delete')->name('admin.delete');
    })->middleware('isAdmin');
    
    Route::controller(StaffController::class)->group(function() {
        Route::get('/staff', 'index')->name('staff');
        Route::get('/staff/detail/{id}', 'detail')->name('staff.detail');
        Route::get('/staff/add', 'create')->name('staff.create');
        Route::post('/staff/add', 'store')->name('staff.store');
        Route::get('/staff/edit/{id}', 'edit')->name('staff.edit');
        Route::post('/staff/edit/{id}', 'update')->name('staff.update');
        Route::post('/staff/delete/{id}', 'delete')->name('staff.delete');
    })->middleware('isAdmin');
    
    Route::controller(TourGuideController::class)->group(function() {
        Route::get('/tourguide', 'index')->name('tourguide');
        Route::get('/tourguide/detail/{id}', 'detail')->name('tourguide.detail');
        Route::get('/tourguide/add', 'create')->name('tourguide.create');
        Route::post('/tourguide/add', 'store')->name('tourguide.store');
        Route::get('/tourguide/edit/{id}', 'edit')->name('tourguide.edit');
        Route::post('/tourguide/edit/{id}', 'update')->name('tourguide.update');
        Route::post('/tourguide/delete/{id}', 'delete')->name('tourguide.delete');
    })->middleware('isAdmin');
    
    Route::controller(CustomerController::class)->group(function() {
        Route::get('/customer', 'index')->name('customer');
        Route::get('/customer/detail/{id}', 'detail')->name('customer.detail');
        Route::get('/customer/add', 'create')->name('customer.create');
        Route::post('/customer/add', 'store')->name('customer.store');
        Route::get('/customer/edit/{id}', 'edit')->name('customer.edit');
        Route::post('/customer/edit/{id}', 'update')->name('customer.update');
        Route::post('/customer/delete/{id}', 'delete')->name('customer.delete');
    })->middleware('isAdmin');

    Route::resource('/language', LanguageController::class)->middleware('isAdminStaff');
    Route::resource('/region', RegionController::class)->middleware('isAdminStaff');
    Route::resource('/category', CategoryController::class)->middleware('isAdminStaff');
    Route::resource('/regioncategory', RegionCategoryController::class)->middleware('isAdminStaff');
    Route::resource('/facility', FacilityController::class)->middleware('isAdminStaff');
    Route::resource('/touristsite', TouristSiteController::class)->middleware('isAdminStaff');
    Route::resource('/touristsitefacility', TouristSiteFacilityController::class)->middleware('isAdminStaff');
    Route::resource('/ticketcategory', TicketCategoryController::class)->middleware('isAdminStaff');
    Route::resource('/ticket', TicketController::class)->middleware('isAdminStaff');
    Route::resource('/coupon', CouponController::class)->middleware('isAdminStaff');
    
    Route::controller(TransactionController::class)->group(function() {
        Route::get('/report', 'index')->name('report');
        Route::get('/report/detail/{id}', 'detail')->name('report.detail');
        Route::get('/transaction/getTickets/{id}', 'getTickets');
        Route::get('/transaction/getTicket/{id}/{checkout_date}', 'getTicket');
        Route::get('/transaction/getCoupon/{coupon_code}', 'getCoupon');
        Route::get('/transaction/add', 'create')->name('transaction.create');
        Route::post('/transaction/add', 'store')->name('transaction.store');
    });

    Route::controller(ProfileAdminController::class)->group(function() {
        Route::get('/profile', 'index')->name('profile')->middleware(['isAdmin']);
        Route::get('/profile/edit', 'edit')->name('profile.edit')->middleware(['isAdmin']);
        Route::post('/profile/edit', 'update')->name('profile.update')->middleware(['isAdmin']);
    });

    Route::controller(ProfileStaffController::class)->group(function() {
        Route::get('/profile', 'index')->name('profile')->middleware(['isStaff']);
        Route::get('/profile/edit', 'edit')->name('profile.edit')->middleware(['isStaff']);
        Route::post('/profile/edit', 'update')->name('profile.update')->middleware(['isStaff']);
    });

    Route::controller(ProfileCustomerController::class)->group(function() {
        Route::get('/profile', 'index')->name('profile')->middleware(['isCustomer']);
        Route::get('/profile/edit', 'edit')->name('profile.edit')->middleware(['isCustomer']);
        Route::post('/profile/edit', 'update')->name('profile.update')->middleware(['isCustomer']);
    });
});