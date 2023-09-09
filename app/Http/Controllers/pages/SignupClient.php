<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\MainActivity;
use App\Models\Common;
use App\Models\Province;
use App\Models\StorageCapacity;
use App\Models\OrderCapacity;
use App\Models\Product;
use App\Models\Region;
use App\Models\UserDetail;
use App\Models\EaseOfAccess;
use App\Models\PaymentTerms;

class SignupClient extends Controller
{
  public function index()
  {
    $user = Auth::user();

    if ($user->accountType != 1 || $user->profile_completed != "No") {
      //if not buyer or profile already completed
      //redirect to home page
      return redirect()->route("dashboard");
    }

    $main_activity = MainActivity::all();
    $common = Common::all();
    $province = Province::all();
    $storage_capacity = StorageCapacity::all();
    $order_capacity = OrderCapacity::all();
    $product = Product::all();
    $region = Region::all();
    $ease_of_access = EaseOfAccess::all();
    $payment_terms = PaymentTerms::all();

    $user_detail = UserDetail::where(['user_id' => $user->id])->first();

    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.pages.pages-signup-client', [
      'pageConfigs' => $pageConfigs,
      "main_activity" => $main_activity,
      "common" => $common,
      "province" => $province,
      "storage_capacity" => $storage_capacity,
      "order_capacity" => $order_capacity,
      "product" => $product,
      "region" => $region,
      "user_detail" => $user_detail,
      "ease_of_access" => $ease_of_access,
      "payment_terms" => $payment_terms,
    ]);
  }
}
