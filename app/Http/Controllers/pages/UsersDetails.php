<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Subscription;
use Auth;
use Stripe;

class UsersDetails extends Controller
{
  public function index()
  {
    $user = Auth::user();
    $user_detail = UserDetail::where(['user_id' => $user->id])->first();
    $subscriptions = Subscription::where(['status' => 'active'])->get();
    $isOnlyProfile = false;

    $payment_methods = [];
    if($user->stripe_customer_id){
      $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
      $payment_methods_data = $stripe->customers->allPaymentMethods(
        $user->stripe_customer_id,
        ["type" => "card"]
      );
      if($payment_methods_data){
        $payment_methods = $payment_methods_data->data;
      }
    }

    return view('content.pages.pages-users-details', [
      'user' => $user,
      'user_detail' => $user_detail,
      'subscriptions' => $subscriptions,
      'isOnlyProfile' => $isOnlyProfile,
      'authUser' => $user,
      'payment_methods' => $payment_methods,
    ]);
  }

  public function view($id)
  {
    $authUser = Auth::user();
    $user_id = Auth::user()->id;
    $user = User::where(['id' => $id])->first();
    $user_detail = UserDetail::where(['user_id' => $id])->first();

    $subscriptions = [];
    $isOnlyProfile = true;
    if($user_id == $id){
      $isOnlyProfile = false;
      $subscriptions = Subscription::where(['status' => 'active'])->get();
    }

    return view('content.pages.pages-users-details', [
      'user' => $user,
      'user_detail' => $user_detail,
      'subscriptions' => $subscriptions,
      'isOnlyProfile' => $isOnlyProfile,
      'authUser' => $authUser,
    ]);
  }
}
