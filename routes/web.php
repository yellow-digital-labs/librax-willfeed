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
Route::get('/approved-customer', $controller_path . '\pages\ApprovedCustomer@index')->name('pages-approved-customer');

// pages
Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');

// Auth pages
Route::get('/forget-password', $controller_path . '\pages\ForgetPassword@index')->name('forget-password');
Route::get('/reset-password', $controller_path . '\pages\ResetPassword@index')->name('reset-password');
Route::get('/verify-email', $controller_path . '\pages\VerifyEmail@index')->name('verify-email');
Route::get('logout', [ App\Http\Controllers\ClientController::class, 'logout'])->name('logout');


//Authentication required
Route::middleware([
    'auth',
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
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

    Route::get('/profile', $controller_path . '\pages\UsersDetails@index')->name('users-details');

    Route::get('/orders', $controller_path . '\pages\Orders@index')->name('orders');
    Route::get('/subscription-plan-management', $controller_path . '\pages\SubscriptionPlanManagement@index')->name('subscription-plan-management');
    Route::get('/reports', $controller_path . '\pages\Reports@index')->name('reports');
    Route::get('/email-template-management', $controller_path . '\pages\EmailTemplateManagement@index')->name('email-template-management');
    Route::get('/management', $controller_path . '\pages\Management@index')->name('management');
    Route::get('/privacy-policy-management', $controller_path . '\pages\PrivacyPolicyManagement@index')->name('privacy-policy-management');
    Route::get('/terms-management', $controller_path . '\pages\TermsManagement@index')->name('terms-management');
    Route::get('/feedback-management', $controller_path . '\pages\FeedbackManagement@index')->name('feedback-management');


    //products
    //general
    Route::get('/products', $controller_path . '\pages\Product@index')->name('product'); //product list view
    Route::get('/products/list', $controller_path . '\pages\Product@list')->name('product-list'); //product list data ajax
    Route::get('/product/create', $controller_path . '\pages\Product@create')->name('product-create'); //product create view
    Route::post('/product/create', $controller_path . '\pages\Product@store')->name('product-store'); //product save
    Route::get('/product/{id}/edit', $controller_path . '\pages\Product@edit')->name('product-edit'); //product edit
    Route::post('/product/{id}/edit', $controller_path . '\pages\Product@update')->name('product-update'); //product update
});