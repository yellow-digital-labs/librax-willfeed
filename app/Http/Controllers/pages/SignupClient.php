<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\UserDetailOldData;
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
use App\Models\PaymentExtension;
use App\Models\ConsumeCapacity;
use App\Helpers\Helpers;
use App\Mail\UserRequest;
use App\Mail\ProfileEditReviewNotification;

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

    $main_activity = Helpers::clientActivityList();
    $region = Region::orderBy('name', 'ASC')->get();
    $common = Common::orderBy('name', 'ASC')->get();
    $province = Province::orderBy('name', 'ASC')->get();
    $storage_capacity = StorageCapacity::all();
    $order_capacity = OrderCapacity::all();
    $product = Product::all();
    $ease_of_access = EaseOfAccess::all();
    $payment_extension = PaymentExtension::all();
    $payment_terms = PaymentTerms::all();
    $consume_capacity = ConsumeCapacity::all();

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
      "payment_extension" => $payment_extension,
      "consume_capacity" => $consume_capacity,
    ]);
  }

  public function store(Request $request)
  {
    $authUser = Auth::user();

    $file_1 = $request->file('file_1')->store('storage');
    $file_2 = $request->file('file_2')->store('storage');
    $file_3 = $request->file('file_3')->store('storage');

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
        'ease_of_access' => $request->ease_of_access,
        'mobile_unloading' => $request->mobile_unloading,
        'destination_address' => $request->destination_address,
        'destination_address_via' => $request->destination_address_via,
        'destination_house_no' => $request->destination_house_no,
        'destination_region' => $request->destination_region,
        'destination_province' => $request->destination_province,
        'destination_common' => $request->destination_common,
        'destination_pincode' => $request->destination_pincode,
        'minor_plant_code' => $request->minor_plant_code,
        'payment_extension' => $request->payment_extension,
        'payment_term' => $request->payment_term,
        'reference_bank' => $request->reference_bank,
        'iban' => $request->iban,
        'sdi' => $request->sdi,
        'cig' => $request->cig,
        'cup' => $request->cup,
        'products' => $request->products,
        'monthly_consumption' => $request->monthly_consumption,
        'is_private_distributer' => $request->is_private_distributer,
        'no_of_distributer' => $request->no_of_distributer,
        'fleet' => $request->fleet,
        'type_of_flotta' => $request->type_of_flotta,
        'folding_trucks' => $request->folding_trucks,
        'van_trucks' => $request->van_trucks,
        'chassis_trucks' => $request->chassis_trucks,
        'fixed_cassone_truck' => $request->fixed_cassone_truck,
        'fridge_truck' => $request->fridge_truck,
        'truck_with_crane' => $request->truck_with_crane,
        'scarble_truck' => $request->scarble_truck,
        'bitoniere' => $request->bitoniere,
        'comircial_vehicle' => $request->comircial_vehicle,
        'semi_trailer' => $request->semi_trailer,
        'trailers' => $request->trailers,
        'file_1' => $file_1,
        'file_2' => $file_2,
        'file_3' => $file_3,
      ]
    );

    //send emil to admin
    $to = explode(',', env('MAIL_TO_ADDRESS'));
    Mail::to($to)->send(new UserRequest([
      "accountTypeName" => $authUser['accountTypeName'],
      "url" => route("user-buyer"),
      "email" => $authUser['email'],
      "name" => $authUser['name'],
    ]));

    return redirect()->route("thankyou-signup");

  }

   public function store_old_data(Request $request){

    $user = Auth::user();
    $id = $user->id;

    $user_detail_old = UserDetailOldData::where(['user_detail_id' =>  $id, "admin_approval"=>"pending"])->first();

    if($user_detail_old){
        return response()->json([
          "error"=>"pendig request found for edit",
          "status" => 400,
          "data"=> [],
      ],400);
    }

    $userDetail = UserDetail::findOrFail( $id);

    // $file_operating_license_path = $userDetail->file_operating_license_path;

    // if($request->hasFile('file_operating_license')){
    //     $file_operating_license_path = $request->file('file_operating_license')->store('storage');
    // }

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
        'ease_of_access' => $request->ease_of_access,
        'mobile_unloading' => $request->mobile_unloading,
        'destination_address' => $request->destination_address,
        'destination_address_via' => $request->destination_address_via,
        'destination_house_no' => $request->destination_house_no,
        'destination_region' => $request->destination_region,
        'destination_province' => $request->destination_province,
        'destination_common' => $request->destination_common,
        'destination_pincode' => $request->destination_pincode,
        'minor_plant_code' => $request->minor_plant_code,
        'payment_extension' => $request->payment_extension,
        'payment_term' => $request->payment_term,
        'reference_bank' => $request->reference_bank,
        'iban' => $request->iban,
        'sdi' => $request->sdi,
        'cig' => $request->cig,
        'cup' => $request->cup,
        'products' => $request->products,
        'monthly_consumption' => $request->monthly_consumption,
        'is_private_distributer' => $request->is_private_distributer,
        'no_of_distributer' => $request->no_of_distributer,
        'fleet' => $request->fleet,
        'type_of_flotta' => $request->type_of_flotta,
        'folding_trucks' => $request->folding_trucks,
        'van_trucks' => $request->van_trucks,
        'chassis_trucks' => $request->chassis_trucks,
        'fixed_cassone_truck' => $request->fixed_cassone_truck,
        'fridge_truck' => $request->fridge_truck,
        'truck_with_crane' => $request->truck_with_crane,
        'scarble_truck' => $request->scarble_truck,
        'bitoniere' => $request->bitoniere,
        'comircial_vehicle' => $request->comircial_vehicle,
        'semi_trailer' => $request->semi_trailer,
        'trailers' => $request->trailers,
        // 'file_1' => $file_1,
        // 'file_2' => $file_2,
        // 'file_3' => $file_3,
    ]);

    //Set profile_update_request to true in Users table
    $user_profile = User::find($id);
    $user_profile->profile_update_request = 'Yes';
    $user_profile->save();
  
    $to = $user->email;
    $link = route('profile-view', ['id' => $request->user_detail_id]);
    Mail::to($to)->send(new ProfileEditReviewNotification($link, $user));
      
    return response()->json([
        "message"=>'Edit Request Submited for Admin Review',
        "status" => 200,
          "data"=> [],
    ]);
  }
}
