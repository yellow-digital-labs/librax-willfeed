<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\MainActivity;
use App\Models\Common;
use App\Models\Province;
use App\Models\StorageCapacity;
use App\Models\OrderCapacity;
use App\Models\Product;
use App\Models\Region;
use App\Models\UserDetail;
use App\Models\UserDetailOldData;
use App\Mail\UserRequest;
use App\Mail\ProfileEditReviewNotification;

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
    $storage_capacity = StorageCapacity::all();
    $order_capacity = OrderCapacity::all();
    $product = Product::all();
    $region = Region::orderBy('name', 'ASC')->get();
    $common = Common::orderBy('name', 'ASC')->get();
    $province = Province::orderBy('name', 'ASC')->get();

    $user_detail = UserDetail::where(['user_id' => $user->id])->first();

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
      "user_detail" => $user_detail,
    ]);
  }

  public function store(Request $request)
 {
    $authUser = Auth::user();

    $file_operating_license_path = $request->file('file_operating_license')->store('storage');

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
        'region' => $request->region,
        'province' => $request->province,
        'common' => $request->common,
        'pincode' => $request->pincode,
        'storage_capacity' => $request->storage_capacity,
        'order_capacity_limits' => $request->order_capacity_limits,
        'order_capacity_limits_new' => $request->order_capacity_limits_new,
        'available_products' => implode(",",$request->available_products),
        'geographical_coverage_regions' => implode(",",$request->geographical_coverage_regions),
        'geographical_coverage_provinces' => implode(",",$request->geographical_coverage_provinces),
        'time_limit_daily_order' => $request->time_limit_daily_order,
        'bank_transfer' => $request->bank_transfer,
        'bank_check' => $request->bank_check,
        'bank' => $request->bank,
        'rib' => $request->rib,
        'rid' => $request->rid,
        'file_operating_license' => $file_operating_license_path,
        'updated_by' => $authUser->email
      ]
    );

    //send email to admin
    $to = explode(',', env('MAIL_TO_ADDRESS'));
    Mail::to($to)->send(new UserRequest([
      "accountTypeName" => $authUser['accountTypeName'],
      "url" => route("user-seller"),
      "email" => $authUser['email'],
      "name" => $authUser['name'],
    ]));

    return redirect()->route("thankyou-signup");

  }

  public function store_old_data(Request $request){

    $user = Auth::user();
    $id = $user->id;

    $user_detail_old = UserDetailOldData::where(['user_detail_id' => $id, "admin_approval" => "pending"])->first();

    if($user_detail_old){
        return response()->json([
          "error"=>" Hai già inviato una richiesta di aggiornamento",
          "status" => 400,
          "data"=> [],
      ],400);
    }

    $userDetail = UserDetail::where(["user_id" => $id])->first();

    $file_operating_license_path = $userDetail->file_operating_license;

    if($request->hasFile('file_operating_license')){
        $file_operating_license_path = $request->file('file_operating_license')->store('storage');
    }

    UserDetailOldData::create([
        'user_detail_id' => $id,
        'business_name' => $request->business_name,
        'vat_number' => $request->vat_number,
        'contact_person' => $request->contact_person,
        'pec' => $request->pec,
        'tax_id_code' => $request->tax_id_code,
        'administrator_name' => $request->administrator_name,
        'main_activity_ids' => $request->main_activity_ids,
        'address' => $request->address,
        'house_no' => $request->house_no,
        'region' => $request->region,
        'province' => $request->province,
        'common' => $request->common,
        'pincode' => $request->pincode,
        'storage_capacity' => $request->storage_capacity,
        'order_capacity_limits' => $request->order_capacity_limits,
        'order_capacity_limits_new' => $request->order_capacity_limits_new,
        'available_products' => implode(",", $request->available_products),
        'geographical_coverage_regions' => implode(",", $request->geographical_coverage_regions),
        'geographical_coverage_provinces' => implode(",", $request->geographical_coverage_provinces),
        'time_limit_daily_order' => $request->time_limit_daily_order,
        'bank_transfer' => $request->bank_transfer,
        'bank_check' => $request->bank_check,
        'bank' => $request->bank,
        'rib' => $request->rib,
        'rid' => $request->rid,
        'file_operating_license' => $file_operating_license_path,
        // 'updated_by' => $authUser->email
    ]);

    //Set profile_update_request to true in Users table
    $user_profile = User::find($id);
    $user_profile->profile_update_request = 'Yes';
    $user_profile->save();
  
     //send email to admin
    $to = explode(',', env('MAIL_TO_ADDRESS'));
    $link = route('profile-view', ['id' => $id]);
    Mail::to($to)->send(new ProfileEditReviewNotification($link, $user));
      
    return response()->json([
        "message"=>'Richiesta di modifica inviata',
        "status" => 200,
          "data"=> [],
    ]);
  }
}
