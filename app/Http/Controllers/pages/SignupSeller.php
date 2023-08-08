<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\MainActivity;
use App\Models\Common;
use App\Models\Province;
use App\Models\StorageCapacity;
use App\Models\OrderCapacity;
use App\Models\Product;
use App\Models\Region;
use App\Models\UserDetail;

class SignupSeller extends Controller
{
  public function index()
  {
    $user = Auth::user();

    // $user = User::find($authUser->id);
    if ($user->accountType != 2 || $user->profile_completed != "No") {
      //if not seller or profile already completed
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

    $pageConfigs = ["myLayout" => "blank"];
    return view("content.pages.pages-signup-seller", [
      "pageConfigs" => $pageConfigs,
      "main_activity" => $main_activity,
      "common" => $common,
      "province" => $province,
      "storage_capacity" => $storage_capacity,
      "order_capacity" => $order_capacity,
      "product" => $product,
      "region" => $region,
    ]);
  }

  public function store(Request $request)
  {
    $authUser = Auth::user();

    $users = UserDetail::updateOrCreate(
      ['user_id' => $authUser->id],
      [
        'business_name' => $request->business_name,
        'vat_number' => $request->vat_number,
        'contact_person' => $request->contact_person,
        'pec' => $request->pec,
        'tax_id_code' => $request->tax_id_code,
        'administrator_name' => $request->administrator_name,
        'main_activity_ids' => $request->main_activity_ids,
        'address' => $request->address,
        'house_no' => $request->house_no,
        'common' => $request->common,
        'province' => $request->province,
        'pincode' => $request->pincode,
        'storage_capacity' => $request->storage_capacity,
        'order_capacity_limits' => $request->order_capacity_limits,
        'available_products' => $request->available_products,
        'geographical_coverage_regions' => $request->geographical_coverage_regions,
        'geographical_coverage_provinces' => $request->geographical_coverage_provinces,
        'time_limit_daily_order' => $request->time_limit_daily_order,
        'bank_transfer' => $request->bank_transfer,
        'bank_check' => $request->bank_check,
        'rib' => $request->rib,
        'rid' => $request->rid,
        'updated_by' => $authUser->email
      ]
    );

    return redirect()->route("thankyou-signup");

  }
}
