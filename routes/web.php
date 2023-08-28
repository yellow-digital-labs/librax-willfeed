<?php

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

$controller_path = 'App\Http\Controllers';

// Main Page Route
Route::get('/', $controller_path . '\pages\HomePage@index')->name('pages-home');

// pages
Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');

// Auth pages
Route::get('/forget-password', $controller_path . '\pages\ForgetPassword@index')->name('forget-password');
Route::get('/reset-password', $controller_path . '\pages\ResetPassword@index')->name('reset-password');
Route::get('/verify-email', $controller_path . '\pages\VerifyEmail@index')->name('verify-email');
Route::get('/verify-email/{token}', $controller_path . '\pages\VerifyEmail@confirm')->name('verify-email-confirm');
Route::get('logout', [ App\Http\Controllers\ClientController::class, 'logout'])->name('logout');


Route::get('/home', $controller_path . '\pages\MainHome@index')->name('pages-main-home');

// Admin Pages
Route::get('/admin', $controller_path . '\Admin@login')->name('admin-login');
Route::get('/customer-rating', $controller_path . '\pages\CustomerRating@index')->name('pages-customer-rating');
Route::get('/email-management', $controller_path . '\pages\EmailManagement@index')->name('pages-email-management');


//Authentication required
Route::middleware([
    'auth',
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'VerifiedUser'
])->group(function () {
    $controller_path = 'App\Http\Controllers';

    Route::get('/signup/client', $controller_path . '\pages\SignupClient@index')->name('signup-client');
    Route::get('/signup/seller', $controller_path . '\pages\SignupSeller@index')->name('signup-seller');
    Route::post('/signup/seller', $controller_path . '\pages\SignupSeller@store')->name('signup-seller-store');

    Route::get('/thankyou/signup', $controller_path . '\Thankyou@signup')->name('thankyou-signup');
});

Route::middleware([
    'auth',
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'access'
])->group(function () {
    $controller_path = 'App\Http\Controllers';

    Route::get('/dashboard', $controller_path . '\pages\Dashboard@index')->name('dashboard');

    //
    Route::get('/unverified-users', $controller_path . '\pages\UnverifiedUser@index')->name('unverified-users');

    Route::get('/profile', $controller_path . '\pages\UsersDetails@index')->name('profile');
    Route::get('/profile/{id}/view', $controller_path . '\pages\UsersDetails@view')->name('profile-view'); //profile view

    Route::get('/reports', $controller_path . '\pages\Reports@index')->name('reports');
    Route::get('/email-template-management', $controller_path . '\pages\EmailTemplateManagement@index')->name('email-template-management');
    Route::get('/management', $controller_path . '\pages\Management@index')->name('management');
    Route::get('/feedback-management', $controller_path . '\pages\FeedbackManagement@index')->name('feedback-management');


    //products
    //general
    Route::get('/products', $controller_path . '\pages\Product@index')->name('product'); //product list view
    Route::get('/products/list', $controller_path . '\pages\Product@list')->name('product-list'); //product list data ajax
    Route::get('/product/create', $controller_path . '\pages\Product@create')->name('product-create'); //product create view
    Route::post('/product/create', $controller_path . '\pages\Product@store')->name('product-store'); //product save
    Route::get('/product/{id}/edit', $controller_path . '\pages\Product@edit')->name('product-edit'); //product edit
    Route::post('/product/{id}/edit', $controller_path . '\pages\Product@update')->name('product-update'); //product update
    Route::get('/admin/product/{id}/edit', $controller_path . '\pages\Product@editAdmin')->name('product-edit'); //product edit admin
    Route::post('/admin/product/{id}/edit', $controller_path . '\pages\Product@updateAdmin')->name('product-update'); //product update admin
    Route::post('/product/{id}/stock', $controller_path . '\pages\Product@stock')->name('product-update-stock'); //product update stock
    Route::post('/product/{id}/detail', $controller_path . '\pages\Product@detail')->name('product-detail'); //product detail ajax
    //admin
    Route::get('/product/add', $controller_path . '\pages\Product@add')->name('product-add'); //admin add new product

    //customer
    Route::get('/customer', $controller_path . '\pages\Customer@index')->name('customer'); //customer list view
    Route::get('/customers/list', $controller_path . '\pages\Customer@list')->name('customer-list'); //customer list data ajax
    Route::post('/customer/{id}/status/{status}', $controller_path . '\pages\Customer@status')->name('customer-status'); //customer status update ajax

    //user
    Route::get('/user', $controller_path . '\pages\User@index')->name('user'); //user list view
    Route::get('/users/list', $controller_path . '\pages\User@list')->name('user-list'); //user list data ajax
    Route::post('/user/{id}/status/{status}', $controller_path . '\pages\User@status')->name('user-status'); //user status update ajax


    //orders
    Route::get('/orders', $controller_path . '\pages\Orders@index')->name('orders'); //order list view
    Route::get('/orders/list', $controller_path . '\pages\Orders@list')->name('order-list'); //order list data ajax
    Route::get('/order/detail/{id}', $controller_path . '\pages\Orders@detail')->name('order-details'); //order detail page
    Route::get('/order/{id}/status/{status}', $controller_path . '\pages\Orders@status')->name('order-status'); //order status update ajax

    //payment
    Route::get('/payments', $controller_path . '\pages\Payments@index')->name('payments'); //payment list view
    Route::get('/payments/list', $controller_path . '\pages\Payments@list')->name('payment-list'); //payment list data ajax
    Route::get('/payment', $controller_path . '\pages\Payments@view')->name('payment-index');
    Route::post('/payment', $controller_path . '\pages\Payments@store')->name('payment-store');

    //subscription plan management
    Route::get('/subscription-plan-management', $controller_path . '\pages\SubscriptionPlanManagement@index')->name('subscription-plan-management');
    Route::get('/subscription-plan-managements/list', $controller_path . '\pages\SubscriptionPlanManagement@list')->name('subscription-plan-management-list'); //subscription list data ajax
    Route::get('/subscription-plan-management/{id}/edit', $controller_path . '\pages\SubscriptionPlanManagement@edit')->name('subscription-plan-management-edit'); //subscription detail data ajax

    //settings
    Route::get('/settings', $controller_path . '\pages\Settings@index')->name('settings'); //settings view
    Route::post('/settings', $controller_path . '\pages\Settings@store')->name('settings-store'); //settings update

    //static pages
    Route::get('/static/pages-terms', $controller_path . '\pages\StaticPagesTerms@index')->name('static-pages-terms');
    Route::get('/static/pages-privacy', $controller_path . '\pages\StaticPagesPrivacy@index')->name('static-pages-privacy');
});