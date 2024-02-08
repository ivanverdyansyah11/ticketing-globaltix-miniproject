<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\LanguageController;
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

    Route::controller(AdminController::class)->group(function() {
        Route::get('/admin', 'index')->name('admin');
        Route::get('/admin/detail/{id}', 'detail')->name('admin.detail');
        Route::get('/admin/add', 'create')->name('admin.create');
        Route::post('/admin/add', 'store')->name('admin.store');
        Route::get('/admin/edit/{id}', 'edit')->name('admin.edit');
        Route::post('/admin/edit/{id}', 'update')->name('admin.update');
        Route::post('/admin/delete/{id}', 'delete')->name('admin.delete');
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

    Route::controller(TourGuideController::class)->group(function() {
        Route::get('/tourguide', 'index')->name('tourguide');
        Route::get('/tourguide/detail/{id}', 'detail')->name('tourguide.detail');
        Route::get('/tourguide/add', 'create')->name('tourguide.create');
        Route::post('/tourguide/add', 'store')->name('tourguide.store');
        Route::get('/tourguide/edit/{id}', 'edit')->name('tourguide.edit');
        Route::post('/tourguide/edit/{id}', 'update')->name('tourguide.update');
        Route::post('/tourguide/delete/{id}', 'delete')->name('tourguide.delete');
    });

    Route::controller(CustomerController::class)->group(function() {
        Route::get('/customer', 'index')->name('customer');
        Route::get('/customer/detail/{id}', 'detail')->name('customer.detail');
        Route::get('/customer/add', 'create')->name('customer.create');
        Route::post('/customer/add', 'store')->name('customer.store');
        Route::get('/customer/edit/{id}', 'edit')->name('customer.edit');
        Route::post('/customer/edit/{id}', 'update')->name('customer.update');
        Route::post('/customer/delete/{id}', 'delete')->name('customer.delete');
    });

    Route::controller(LanguageController::class)->group(function() {
        Route::get('/language', 'index')->name('language');
        Route::get('/language/detail/{id}', 'detail')->name('language.detail');
        Route::post('/language/add', 'store')->name('language.store');
        Route::post('/language/edit/{id}', 'update')->name('language.update');
        Route::post('/language/delete/{id}', 'delete')->name('language.delete');
    });

    Route::controller(RegionController::class)->group(function() {
        Route::get('/region', 'index')->name('region');
        Route::get('/region/detail/{id}', 'detail')->name('region.detail');
        Route::post('/region/add', 'store')->name('region.store');
        Route::post('/region/edit/{id}', 'update')->name('region.update');
        Route::post('/region/delete/{id}', 'delete')->name('region.delete');
    });

    Route::controller(CategoryController::class)->group(function() {
        Route::get('/category', 'index')->name('category');
        Route::get('/category/detail/{id}', 'detail')->name('category.detail');
        Route::post('/category/add', 'store')->name('category.store');
        Route::post('/category/edit/{id}', 'update')->name('category.update');
        Route::post('/category/delete/{id}', 'delete')->name('category.delete');
    });

    Route::controller(RegionCategoryController::class)->group(function() {
        Route::get('/regioncategory', 'index')->name('region_category');
        Route::get('/regioncategory/detail/{id}', 'detail')->name('region_category.detail');
        Route::post('/regioncategory/add', 'store')->name('region_category.store');
        Route::post('/regioncategory/edit/{id}', 'update')->name('region_category.update');
        Route::post('/regioncategory/delete/{id}', 'delete')->name('region_category.delete');
    });

    Route::controller(FacilityController::class)->group(function() {
        Route::get('/facility', 'index')->name('facility');
        Route::get('/facility/detail/{id}', 'detail')->name('facility.detail');
        Route::post('/facility/add', 'store')->name('facility.store');
        Route::post('/facility/edit/{id}', 'update')->name('facility.update');
        Route::post('/facility/delete/{id}', 'delete')->name('facility.delete');
    });

    Route::controller(TouristSiteController::class)->group(function() {
        Route::get('/toursite', 'index')->name('toursite');
        Route::get('/toursite/detail/{id}', 'detail')->name('toursite.detail');
        Route::post('/toursite/add', 'store')->name('toursite.store');
        Route::post('/toursite/edit/{id}', 'update')->name('toursite.update');
        Route::post('/toursite/delete/{id}', 'delete')->name('toursite.delete');
    });

    Route::controller(TouristSiteFacilityController::class)->group(function() {
        Route::get('/toursitefacility', 'index')->name('toursitefacility');
        Route::get('/toursitefacility/detail/{id}', 'detail')->name('toursitefacility.detail');
        Route::post('/toursitefacility/add', 'store')->name('toursitefacility.store');
        Route::post('/toursitefacility/edit/{id}', 'update')->name('toursitefacility.update');
        Route::post('/toursitefacility/delete/{id}', 'delete')->name('toursitefacility.delete');
    });

    Route::controller(TicketCategoryController::class)->group(function() {
        Route::get('/ticketcategory', 'index')->name('ticketcategory');
        Route::get('/ticketcategory/detail/{id}', 'detail')->name('ticketcategory.detail');
        Route::post('/ticketcategory/add', 'store')->name('ticketcategory.store');
        Route::post('/ticketcategory/edit/{id}', 'update')->name('ticketcategory.update');
        Route::post('/ticketcategory/delete/{id}', 'delete')->name('ticketcategory.delete');
    });

    Route::controller(TicketController::class)->group(function() {
        Route::get('/ticket', 'index')->name('ticket');
        Route::get('/ticket/detail/{id}', 'detail')->name('ticket.detail');
        Route::post('/ticket/add', 'store')->name('ticket.store');
        Route::post('/ticket/edit/{id}', 'update')->name('ticket.update');
        Route::post('/ticket/delete/{id}', 'delete')->name('ticket.delete');
    });

    Route::controller(CouponController::class)->group(function() {
        Route::get('/coupon', 'index')->name('coupon');
        Route::get('/coupon/detail/{id}', 'detail')->name('coupon.detail');
        Route::post('/coupon/add', 'store')->name('coupon.store');
        Route::post('/coupon/edit/{id}', 'update')->name('coupon.update');
        Route::post('/coupon/delete/{id}', 'delete')->name('coupon.delete');
    });

    Route::controller(TransactionController::class)->group(function() {
        Route::get('/report', 'index')->name('report');
        Route::get('/report/detail/{id}', 'detail')->name('report.detail');
        Route::get('/transaction/getTickets/{id}', 'getTickets');
        Route::get('/transaction/getTicket/{id}/{checkout_date}', 'getTicket');
        Route::get('/transaction/getCoupon/{coupon_code}', 'getCoupon');
        Route::get('/transaction/add', 'create')->name('transaction.create');
        Route::post('/transaction/add', 'store')->name('transaction.store');
    });
});