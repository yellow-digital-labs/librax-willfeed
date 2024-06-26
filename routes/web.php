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

Route::get('/test', $controller_path . '\Test@index')->name('test');

// pages
Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');

// Auth pages
Route::get('/forget-password', $controller_path . '\pages\ForgetPassword@index')->name('forget-password');
Route::get('/reset-password', $controller_path . '\pages\ResetPassword@index')->name('reset-password');
Route::get('/verify-email', $controller_path . '\pages\VerifyEmail@index')->name('verify-email');
Route::get('/verify-email/resend', $controller_path . '\pages\VerifyEmail@resend')->name('resend-verify-email');
Route::get('/verify-email/{token}', $controller_path . '\pages\VerifyEmail@confirm')->name('verify-email-confirm');
// Route::get('logout', [ App\Http\Controllers\ClientController::class, 'logout'])->name('logout-post');


// Route::get('/home', $controller_path . '\pages\MainHome@index')->name('pages-main-home');
Route::get('/about-us', $controller_path . '\pages\PageAboutus@index')->name('pages-aboutus');
Route::get('/contact-us', $controller_path . '\pages\PageContactus@index')->name('pages-contactus');
Route::get('/contact-us/thankyou', $controller_path . '\pages\PageContactus@thankyou')->name('pages-contactus-thankyou');
Route::post('/contact-us', $controller_path . '\pages\PageContactus@store')->name('pages-contactus-store');
Route::get('/terms', $controller_path . '\pages\PageTerms@index')->name('pages-terms');
Route::get('/privacy', $controller_path . '\pages\PagePrivacy@index')->name('pages-privacy');
Route::get('/cookie-policy', $controller_path . '\pages\PagePrivacy@cookie')->name('pages-cookie-policy');
Route::get('/faqs', $controller_path . '\pages\PageFaqs@index')->name('pages-faqs');

// Admin Pages
Route::get('/admin', $controller_path . '\Admin@login')->name('admin-login');

//Buyer Home screen


//Blog detail page
Route::get('/blog/{slug}', $controller_path . '\pages\BlogsManagement@view')->name('blog-page');

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
    Route::post('/signup/client', $controller_path . '\pages\SignupClient@store')->name('signup-client-store');
    Route::get('/signup/seller', $controller_path . '\pages\SignupSeller@index')->name('signup-seller');
    Route::post('/signup/seller', $controller_path . '\pages\SignupSeller@store')->name('signup-seller-store');
    Route::post('/edit/seller/profile', $controller_path . '\pages\SignupSeller@store_old_data')->name('edit-seller-profile');
    Route::post('/edit/buyer/profile', $controller_path . '\pages\SignupClient@store_old_data')->name('edit-buyer-profile');

    Route::get('/thankyou/signup', $controller_path . '\Thankyou@signup')->name('thankyou-signup');
    Route::get('/reject/signup', $controller_path . '\Thankyou@reject')->name('reject-signup');
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
    Route::get('/buyer-home', $controller_path . '\pages\BuyerHome@index')->name('pages-buyer-home');

    //
    Route::get('/unverified-users', $controller_path . '\pages\UnverifiedUser@index')->name('unverified-users');

    Route::get('/profile', $controller_path . '\pages\UsersDetails@index')->name('profile');
    Route::get('/profile/edit',$controller_path . '\pages\UsersDetails@edit')->name('profile-edit'); // Edit Profile
    Route::get('/profile/{id}/view', $controller_path . '\pages\UsersDetails@view')->name('profile-view'); //profile view
    Route::get('/plan/update/{planid}', $controller_path . '\pages\UsersDetails@updatePlan')->name('plan-update');
    Route::post('/user/{id}/extend-free-trial', $controller_path . '\pages\UsersDetails@extendFreeTrial')->name('users.extend-free-trial'); // Extend Free  Trail 
    Route::post('/approve/{id}/data',  $controller_path . '\pages\UsersDetails@approveData')->name('approve-edit-data'); // Reject Profile Update
    Route::post('/reject/{id}/data',  $controller_path . '\pages\UsersDetails@rejectData')->name('reject-edit-data'); // Accept Profile Update
    Route::get('/pdf/{filename}',  $controller_path . '\pages\'UsersDetails@showPdf')->name('pdf.show'); // Show Pdf
    
    //products
    //general
    Route::get('/products', $controller_path . '\pages\Product@index')->name('product'); //product list view
    Route::get('/products/list', $controller_path . '\pages\Product@list')->name('product-list'); //product list data ajax
    Route::get('/product/create', $controller_path . '\pages\Product@create')->name('product-create'); //product create view
    Route::post('/product/create', $controller_path . '\pages\Product@store')->name('product-store'); //product save
    Route::get('/product/{id}/edit', $controller_path . '\pages\Product@edit')->name('product-edit'); //product edit
    Route::post('/product/{id}/edit', $controller_path . '\pages\Product@update')->name('product-update'); //product update
    Route::delete('/product/{id}', $controller_path . '\pages\Product@delete')->name('product-delete'); //product delete
    Route::delete('/admin/product/{id}', $controller_path . '\pages\Product@deleteAdmin')->name('product-delete-admin'); //product delete
    Route::get('/admin/product/{id}/edit', $controller_path . '\pages\Product@editAdmin')->name('product-edit-admin'); //product edit admin
    Route::post('/admin/product/{id}/edit', $controller_path . '\pages\Product@updateAdmin')->name('product-update-admin'); //product update admin
    Route::post('/product/{id}/stock', $controller_path . '\pages\Product@stock')->name('product-update-stock'); //product update stock
    Route::post('/product/{id}/detail', $controller_path . '\pages\Product@detail')->name('product-detail'); //product detail ajax
    //admin
    Route::get('/product/add', $controller_path . '\pages\Product@add')->name('product-add'); //admin add new product page
    Route::post('/product/add', $controller_path . '\pages\Product@updateAdmin')->name('product-add-form'); //admin add new product

    //customer
    Route::get('/customer', $controller_path . '\pages\Customer@index')->name('customer'); //customer list view
    Route::get('/seller', $controller_path . '\pages\Customer@index')->name('seller'); //seller list view
    Route::get('/customers/list', $controller_path . '\pages\Customer@list')->name('customer-list'); //customer list data ajax
    Route::post('/customer/{id}/status/{status}', $controller_path . '\pages\Customer@status')->name('customer-status'); //customer status update ajax
    Route::post('/customer/{id}/group/{status}', $controller_path . '\pages\Customer@group')->name('customer-group-update'); //customer group update ajax

    //user
    Route::get('/user/seller', $controller_path . '\pages\User@seller')->name('user-seller'); //user seller list view
    Route::get('/user/buyer', $controller_path . '\pages\User@buyer')->name('user-buyer'); //user buyer list view
    Route::get('/users/list/{type}', $controller_path . '\pages\User@list')->name('user-list'); //user list data ajax
    Route::post('/user/{id}/status/{status}', $controller_path . '\pages\User@status')->name('user-status'); //user status update ajax

    //customer groups
    Route::get('/customer-group-management', $controller_path . '\CustomerGroupManagementController@index')->name('customer-group-management');
    Route::get('/customer-group-management/list', $controller_path . '\CustomerGroupManagementController@list')->name('customer-group-management-list'); //customer group list data ajax
    Route::get('/customer-group-management/create', $controller_path . '\CustomerGroupManagementController@create')->name('CustomerGroupManagementController-create'); //product create view
    Route::post('/customer-group-management/create', $controller_path . '\CustomerGroupManagementController@add')->name('customer-group-management-add');
    Route::get('/customer-group-management/{id}/edit', $controller_path . '\CustomerGroupManagementController@edit')->name('customer-group-management-edit'); //customer group detail data ajax
    Route::post('/customer-group-management/{id}/edit', $controller_path . '\CustomerGroupManagementController@store')->name('customer-group-management-store'); //customer group detail data ajax
    Route::delete('/customer-group-management/delete/{id}', $controller_path . '\CustomerGroupManagementController@delete')->name('customer-group-management-delete'); //customer management delete

    //orders
    Route::get('/orders', $controller_path . '\pages\Orders@index')->name('orders'); //order list view
    Route::get('/orders/list', $controller_path . '\pages\Orders@list')->name('order-list'); //order list data ajax
    Route::get('/order/detail/{id}', $controller_path . '\pages\Orders@detail')->name('order-details'); //order detail page
    Route::get('/order/{id}/status/{status}', $controller_path . '\pages\Orders@status')->name('order-status'); //order status update ajax
    Route::post('/order/{id}/status/{status}', $controller_path . '\pages\Orders@status')->name('order-status-post'); //order status update ajax
    Route::get('/order/payment/{id}', $controller_path . '\pages\Orders@payment')->name('add-order-payment'); //order payment add by seller

    //payment
    Route::get('/payments', $controller_path . '\pages\Payments@index')->name('payments'); //payment list view
    Route::get('/payments/list', $controller_path . '\pages\Payments@list')->name('payment-list'); //payment list data ajax
    Route::get('/payment', $controller_path . '\pages\Payments@view')->name('payment-index');
    Route::post('/payment', $controller_path . '\pages\Payments@store')->name('payment-store');

    //subscription plan management
    Route::get('/subscription-plan-management', $controller_path . '\pages\SubscriptionPlanManagement@index')->name('subscription-plan-management');
    Route::get('/subscription-plan-managements/list', $controller_path . '\pages\SubscriptionPlanManagement@list')->name('subscription-plan-management-list'); //subscription list data ajax
    Route::post('/subscription-plan-management', $controller_path . '\pages\SubscriptionPlanManagement@add')->name('subscription-plan-management-add');
    Route::get('/subscription-plan-management/{id}/edit', $controller_path . '\pages\SubscriptionPlanManagement@edit')->name('subscription-plan-management-edit'); //subscription detail data ajax
    Route::post('/subscription-plan-management/{id}/edit', $controller_path . '\pages\SubscriptionPlanManagement@store')->name('subscription-plan-management-store'); //subscription detail data ajax

    //settings
    Route::get('/settings', $controller_path . '\pages\Settings@index')->name('settings'); //settings view
    Route::post('/settings', $controller_path . '\pages\Settings@store')->name('settings-store'); //settings update
    Route::post('/change-email',  $controller_path . '\pages\Settings@sendVerificationLink')->name('email.sendVerificationLink');
    Route::get('/verify-modify-email/{token}', $controller_path . '\pages\Settings@verifyEmail')->name('modify.email-verification');



    //static pages
    Route::get('/static/pages-terms', $controller_path . '\pages\StaticPagesTerms@index')->name('static-pages-terms');
    Route::get('/static/pages-privacy', $controller_path . '\pages\StaticPagesPrivacy@index')->name('static-pages-privacy');
    Route::post('/static/page/save', $controller_path . '\pages\StaticPagesPrivacy@save')->name('save-static-page');

    //customer rating
    Route::get('/customer-ratings', $controller_path . '\pages\CustomerRating@index')->name('customer-rating'); //customer rating view
    Route::get('/customer-ratings/list', $controller_path . '\pages\CustomerRating@list')->name('customer-rating-list'); //customer rating list data ajax
    Route::get('/customer-rating/{id}/edit', $controller_path . '\pages\CustomerRating@edit')->name('customer-rating-details'); //customer rating detail page
    Route::post('/customer-rating/{id}/status/{status}', $controller_path . '\pages\CustomerRating@status')->name('customer-rating-status'); //customer rating status update ajax
    Route::post('/customer-rating/add', $controller_path . '\pages\CustomerRating@add')->name('customer-rating-add');

    //email management
    Route::get('/email-template-management', $controller_path . '\pages\EmailTemplateManagement@index')->name('email-template-management'); //email management view
    Route::get('/email-template-management/list', $controller_path . '\pages\EmailTemplateManagement@list')->name('email-template-management-list'); //email management list data ajax
    Route::get('/email-template-management/{id}/edit', $controller_path . '\pages\EmailTemplateManagement@edit')->name('email-template-management-edit'); //email template edit view
    Route::post('/email-template-management/{id}/edit', $controller_path . '\pages\EmailTemplateManagement@update')->name('email-template-management-update'); //email template update

    //email history
    Route::get('/email-management', $controller_path . '\pages\EmailManagement@index')->name('email-management');
    Route::post('/email-management/{id}/detail', $controller_path . '\pages\EmailManagement@detail')->name('email-management-detail');

    //stripe management
    Route::controller(App\Http\Controllers\StripePaymentController::class)->group(function(){
        Route::get('stripe', 'stripe');
        Route::post('stripe', 'stripePost')->name('stripe.post');
        Route::get('stripe/card/delete', 'stripeDelete')->name('stripe.payment.delete');
    });

    //buyer checkout and order pages
    Route::get('/buyer-checkout/{seller_product_id}/{csrf}', $controller_path . '\pages\BuyerCheckout@index')->name('pages-buyer-checkout');
    Route::post('/buyer-checkout/{seller_product_id}/{csrf}', $controller_path . '\pages\BuyerCheckout@store')->name('pages-buyer-checkout-store');
    Route::get('/buyer-checkout-thanks/{order_id}', $controller_path . '\pages\BuyerCheckoutThanks@index')->name('pages-buyer-checkout-thanks');

    //request seller for profile verification
    Route::get('/customer-request-to-seller/{seller_id}/{csrf}', $controller_path . '\pages\BuyerCheckout@customerRequest')->name('customer-request-to-seller');
    Route::get('/customer-request-to-seller-thanks/{seller_id}', $controller_path . '\pages\BuyerCheckout@customerRequestThanks')->name('customer-request-to-seller-thanks');
    Route::post('/seller-request-to-buyer/{csrf}', $controller_path . '\pages\BuyerCheckout@sellerRequest')->name('seller-request-to-buyer');
    Route::get('/customer-request-to-buyer-thanks/{buyer_id}', $controller_path . '\pages\BuyerCheckout@sellerRequestThanks')->name('seller-request-to-buyer-thanks');
    Route::get('/customer-unauthorized/{seller_id}', $controller_path . '\pages\BuyerCheckout@customerUnauthorized')->name('customer-unauthorized');

    //blogs management
    Route::get('/blogs/management', $controller_path . '\pages\BlogsManagement@index')->name('blogs-management');
    Route::get('/blogs/list', $controller_path . '\pages\BlogsManagement@list')->name('blogs-management-list'); //blogs list data ajax
    Route::get('/blogs/add', $controller_path . '\pages\BlogsManagement@add')->name('blogs-management-add'); //admin add new blog page
    Route::post('/blogs/add', $controller_path . '\pages\BlogsManagement@store')->name('blogs-management-store'); //product save
    Route::get('/blogs/edit/{id}', $controller_path . '\pages\BlogsManagement@edit')->name('blogs-management-edit'); //blogs edit
    Route::post('/blogs/edit/{id}', $controller_path . '\pages\BlogsManagement@update')->name('blogs-management-update'); //blogs update
    Route::delete('/blogs/delete/{id}', $controller_path . '\pages\BlogsManagement@delete')->name('blogs-management-delete'); //blog delete

    //cookie list
    Route::get('/admin/cookie', $controller_path . '\CookieAdmin@index')->name('cookie-admin'); //order list view
    Route::get('/admin/cookie/list', $controller_path . '\CookieAdmin@list')->name('cookie-admin-list'); //order list data ajax

    //notification
    Route::post('/notification/read/{id}', $controller_path . '\Notification@read')->name('notification-read'); //notification read
});