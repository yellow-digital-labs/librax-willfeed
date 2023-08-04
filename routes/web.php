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

// authentication
Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');

// Auth pages
Route::get('/signup', $controller_path . '\pages\Signup@index')->name('signup');
Route::get('/signup/client', $controller_path . '\pages\SignupClient@index')->name('signup-client');
Route::get('/signup/seller', $controller_path . '\pages\SignupSeller@index')->name('signup-seller');
Route::get('/login', $controller_path . '\pages\Login@index')->name('login');
Route::get('/forget-password', $controller_path . '\pages\ForgetPassword@index')->name('forget-password');
Route::get('/reset-password', $controller_path . '\pages\ResetPassword@index')->name('reset-password');
Route::get('/verify-email', $controller_path . '\pages\VerifyEmail@index')->name('verify-email');

//
Route::get('/unverified-users', $controller_path . '\pages\UnverifiedUser@index')->name('unverified-users');

Route::get('/users-details', $controller_path . '\pages\UsersDetails@index')->name('users-details');

Route::get('/orders', $controller_path . '\pages\Orders@index')->name('orders');
Route::get('/subscription-plan-management', $controller_path . '\pages\SubscriptionPlanManagement@index')->name('subscription-plan-management');
Route::get('/reports', $controller_path . '\pages\Reports@index')->name('reports');
Route::get('/email-template-management', $controller_path . '\pages\EmailTemplateManagement@index')->name('email-template-management');
Route::get('/management', $controller_path . '\pages\Management@index')->name('management');
Route::get('/privacy-policy-management', $controller_path . '\pages\PrivacyPolicyManagement@index')->name('privacy-policy-management');
Route::get('/terms-management', $controller_path . '\pages\TermsManagement@index')->name('terms-management');
Route::get('/feedback-management', $controller_path . '\pages\FeedbackManagement@index')->name('feedback-management');


Route::get('/prodotti', $controller_path . '\pages\Prodotti@index')->name('prodotti');

//Authentication required
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    $controller_path = 'App\Http\Controllers';

    
});
