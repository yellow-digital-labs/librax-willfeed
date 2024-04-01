<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Subscription;
use App\Helpers\Helpers;
use Auth;
use Stripe;
use Redirect;
use Carbon\Carbon;

class UsersDetails extends Controller
{
  public function index(Request $request)
  {
    $is_expired = $request->get('expired');
    $user = Auth::user();
    $isAdmin = Helpers::isAdmin();
    $isSeller = Helpers::isSeller();
    $isBuyer = Helpers::isBuyer();
    $user_detail = UserDetail::where(['user_id' => $user->id])->first();
    $subscriptions = [];
    if($isSeller){
      $subscriptions = Subscription::where(['status' => 'active', 'plan_for' => 'seller'])->get();
    }
    if($isBuyer){
      $subscriptions = Subscription::where(['status' => 'active', 'plan_for' => 'buyer'])->get();
    }
    if($isAdmin){
      $subscriptions = Subscription::where(['status' => 'active'])->get();
    }
    $isOnlyProfile = false;

    $payment_methods = [];
    // if($user->stripe_customer_id){
    //   $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    //   $payment_methods_data = $stripe->customers->allPaymentMethods(
    //     $user->stripe_customer_id,
    //     ["type" => "card"]
    //   );
    //   if($payment_methods_data){
    //     $payment_methods = $payment_methods_data->data;
    //   }
    // }

    return view('content.pages.pages-users-details', [
      'user' => $user,
      'user_detail' => $user_detail,
      'subscriptions' => $subscriptions,
      'isOnlyProfile' => $isOnlyProfile,
      'authUser' => $user,
      'payment_methods' => $payment_methods,
      'is_expired' => $is_expired
    ]);
  }

  public function view($id)
  {
    $authUser = Auth::user();
    $user_id = Auth::user()->id;
    $user = User::where(['id' => $id])->first();
    $user_detail = UserDetail::where(['user_id' => $id])->first();
    $isAdmin = Helpers::isAdmin();
    $isSeller = Helpers::isSeller();
    $isBuyer = Helpers::isBuyer();

    $subscriptions = [];
    $payment_methods = [];
    $isOnlyProfile = true;
    if($user_id == $id){
      $isOnlyProfile = false;
      if($isSeller){
        $subscriptions = Subscription::where(['status' => 'active', 'plan_for' => 'seller'])->get();
      }
      if($isBuyer){
        $subscriptions = Subscription::where(['status' => 'active', 'plan_for' => 'buyer'])->get();
      }
      if($isAdmin){
        $subscriptions = Subscription::where(['status' => 'active'])->get();
      }

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
    }

    return view('content.pages.pages-users-details', [
      'user' => $user,
      'user_detail' => $user_detail,
      'subscriptions' => $subscriptions,
      'isOnlyProfile' => $isOnlyProfile,
      'authUser' => $authUser,
      'payment_methods' => $payment_methods,
      'is_expired' => null,
    ]);
  }

  public function updatePlan(Request $request, $planid){
    $isSeller = Helpers::isSeller();
    $isBuyer = Helpers::isBuyer();
    //check plan available
    $subscriptions = [];
    if($isSeller){
      $subscriptions = Subscription::where(['status' => 'active', 'plan_for' => 'seller', "id" => $planid])->first();
    }
    if($isBuyer){
      $subscriptions = Subscription::where(['status' => 'active', 'plan_for' => 'buyer', "id" => $planid])->first();
    }

    if($subscriptions){
      //update plan
      $user_id = Auth::user()->id;
      User::where(["id" => $user_id])->update([
        "subscription_id" => $planid
      ]);

      return redirect()->route("profile");
    } else {
      return Redirect::back()->withErrors([
        "msg" => "Invalid plan subscription request",
      ]);
    }
  }

public function extendFreeTrial($id) {
    try {
        $today = Carbon::now();
        $user = User::findOrFail($id);
        $exp_date = Carbon::parse($user->exp_datetime);
        $newExpiryDate = $exp_date;

        if ($exp_date > $today) {
            // Trial is still active, extend from expiry date
            $newExpiryDate = $exp_date->addDays(30);
        } else {
            // Trial has expired, extend from today
            $newExpiryDate = $today->addDays(30);
        }

        $user->exp_datetime = $newExpiryDate;
        $user->save();

        return response()->json([
            "message" => "Success",
            "code" => 200,
            "data" => $user,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            "message" => $e->getMessage(),
            "code" => 500,
            "data" => [],
        ], 500);
    }
  }
}
