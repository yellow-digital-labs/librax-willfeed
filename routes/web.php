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
Route::get('/unverified-users', $controller_path . '\pages\UnverifiedUser@index')->name('unverified-users');
Route::get('/orders', $controller_path . '\pages\Orders@index')->name('orders');
Route::get('/subscription-plan-management', $controller_path . '\pages\SubscriptionPlanManagement@index')->name('subscription-plan-management');
Route::get('/reports', $controller_path . '\pages\Reports@index')->name('reports');
Route::get('/email-template-management', $controller_path . '\pages\EmailTemplateManagement@index')->name('email-template-management');
Route::get('/management', $controller_path . '\pages\Management@index')->name('management');
Route::get('/privacy-policy-management', $controller_path . '\pages\PrivacyPolicyManagement@index')->name('privacy-policy-management');
Route::get('/terms-management', $controller_path . '\pages\TermsManagement@index')->name('terms-management');
Route::get('/feedback-management', $controller_path . '\pages\FeedbackManagement@index')->name('feedback-management');

// pages
Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');

// authentication
Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');
