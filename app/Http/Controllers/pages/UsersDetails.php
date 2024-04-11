<?php

namespace App\Http\Controllers\pages;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProfileEditNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Subscription;
use App\Helpers\Helpers;
use App\Models\MainActivity;
use App\Models\Common;
use App\Models\Province;
use App\Models\StorageCapacity;
use App\Models\OrderCapacity;
use App\Models\Product;
use App\Models\Region;
use App\Models\EaseOfAccess;
use App\Models\PaymentTerms;
use App\Models\PaymentExtension;
use App\Models\ConsumeCapacity;
use App\Models\UserDetailOldData;
use App\Mail\UserRequest;
use Auth;
use Stripe;
use Redirect;
use Carbon\Carbon;

class UsersDetails extends Controller
{
  public function index(Request $request){
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

    // $main_activity = Helpers::clientActivityList();
    // $region = Region::orderBy('name', 'ASC')->get();
    // $common = Common::orderBy('name', 'ASC')->get();
    // $province = Province::orderBy('name', 'ASC')->get();
    // $storage_capacity = StorageCapacity::all();
    // $order_capacity = OrderCapacity::all();
    // $product = Product::all();
    // $ease_of_access = EaseOfAccess::all();
    // $payment_extension = PaymentExtension::all();
    // $payment_terms = PaymentTerms::all();
    // $consume_capacity = ConsumeCapacity::all();

    $user_detail = UserDetail::where(['user_id' => $user->id])->first();
    $new_user_detail = UserDetailOldData::where(['user_detail_id'=>$user->id, 'admin_approval'=>"pending"])->first();
    $is_new_data = false;
    if($new_user_detail){
      $is_new_data = true;
    }
    return view('content.pages.pages-users-details', [
      'user' => $user,
      'user_detail' => $user_detail,
      'new_user_detail'=>$new_user_detail,
      'subscriptions' => $subscriptions,
      'isOnlyProfile' => $isOnlyProfile,
      'authUser' => $user,
      'payment_methods' => $payment_methods,
      'is_expired' => $is_expired,
        //New Code

      'is_new_data' => $is_new_data,
      // "main_activity" => $main_activity,
      // "common" => $common,
      // "province" => $province,
      // "storage_capacity" => $storage_capacity,
      // "order_capacity" => $order_capacity,
      // "product" => $product,
      // "region" => $region,
      // "user_detail" => $user_detail,
      // "ease_of_access" => $ease_of_access,
      // "payment_terms" => $payment_terms,
      // "payment_extension" => $payment_extension,
      // "consume_capacity" => $consume_capacity,
    ]);
  }

  public function view($id){
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
    }

    $new_user_detail = UserDetailOldData::where(['user_detail_id'=>$id,"admin_approval" => "pending"])->first();
    $is_new_data = false;
    if($new_user_detail){
      $is_new_data = true;
    }

    return view('content.pages.pages-users-details', [
      'user' => $user,
      'user_detail' => $user_detail,
      'new_user_detail'=>$new_user_detail,
      'subscriptions' => $subscriptions,
      'isOnlyProfile' => $isOnlyProfile,
      'authUser' => $authUser,
      'payment_methods' => $payment_methods,
      'is_expired' => null,

      //new Data
      'is_new_data' => $is_new_data,

    ]);
  }

  public function edit(){
    $id = Auth::user()->id;
    $authUser = Auth::user();
    $user_id = Auth::user()->id;
    $user = User::where(['id' => $id])->first();
    $isAdmin = Helpers::isAdmin();
    $isSeller = Helpers::isSeller();
    $isBuyer = Helpers::isBuyer();

    $subscriptions = [];
    $payment_methods = [];
    $isOnlyProfile = true;
    // if($user_id == $id){
    //   $isOnlyProfile = false;
    //   if($isSeller){
    //     $subscriptions = Subscription::where(['status' => 'active', 'plan_for' => 'seller'])->get();
    //   }
    //   if($isBuyer){
    //     $subscriptions = Subscription::where(['status' => 'active', 'plan_for' => 'buyer'])->get();
    //   }
    //   if($isAdmin){
    //     $subscriptions = Subscription::where(['status' => 'active'])->get();
    //   }

    //   // if($user->stripe_customer_id){
    //   //   $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    //   //   $payment_methods_data = $stripe->customers->allPaymentMethods(
    //   //     $user->stripe_customer_id,
    //   //     ["type" => "card"]
    //   //   );
    //   //   if($payment_methods_data){
    //   //     $payment_methods = $payment_methods_data->data;
    //   //   }
    //   // }
    // }


    $user_detail_old = UserDetailOldData::where(['user_detail_id' =>  $id, "admin_approval"=>"pending"])->first();

    if($user_detail_old){
      return redirect()->route('profile');
    }

    $user = User::where(['id' => $id])->first();
    $user_detail = UserDetail::where(['user_id' => $id])->first();

    if($user->accountType == 1){
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

        return view('content.pages.pages-buyer-edit-profile', [
        //new Data
        "user_detail"=>$user_detail,
        "main_activity" => $main_activity,
        "common" => $common,
        "province" => $province,
        "storage_capacity" => $storage_capacity,
        "order_capacity" => $order_capacity,
        "product" => $product,
        "region" => $region,
        "user" => $user,
        "ease_of_access" => $ease_of_access,
        "payment_terms" => $payment_terms,
        "payment_extension" => $payment_extension,
        "consume_capacity" => $consume_capacity,
      ]);
  }
  else{

    $main_activity = MainActivity::all();
    $storage_capacity = StorageCapacity::all();
    $order_capacity = OrderCapacity::all();
    $product = Product::all();
    $region = Region::orderBy('name', 'ASC')->get();
    $common = Common::orderBy('name', 'ASC')->get();
    $province = Province::orderBy('name', 'ASC')->get();

    $user_detail = UserDetail::where(['user_id' => $user->id])->first();

      return view('content.pages.pages-seller-edit-profile', [
      "main_activity" => $main_activity,
      "common" => $common,
      "province" => $province,
      "storage_capacity" => $storage_capacity,
      "order_capacity" => $order_capacity,
      "product" => $product,
      "region" => $region,
      "user_detail" => $user_detail,

      //Pages data
      'user' => $user,
      'subscriptions' => $subscriptions,
      'isOnlyProfile' => $isOnlyProfile,
      'authUser' => $authUser,
      'payment_methods' => $payment_methods,
      'is_expired' => null,

    ]);
   }
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

      $last_update_exp_date = $user->last_update_exp_datetime ? Carbon::parse($user->last_update_exp_datetime) : null;

      if ($last_update_exp_date && $last_update_exp_date->addDays(30)->isFuture()) {
        return response()->json([
            "message" => "È possibile estendere la prova solo una volta ogni 30 giorni.",
            "code" => 500,
            "data" => [],
        ], 500);
      }

        if ($exp_date > $today) {
            // Trial is still active, extend from expiry date
            $newExpiryDate = $exp_date->addDays(30);
        } else {
            // Trial has expired, extend from today
            $newExpiryDate = $today->addDays(30);
        }

        $user->exp_datetime = $newExpiryDate;
        $user->last_update_exp_datetime = $today;
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

  public function approveData(Request $request,$id) {

    $user = User::where(['id' => $id])->first();
    $userDetail = UserDetail::where('user_id', $id)->first();
    $newData = UserDetailOldData::where('user_detail_id', $id)->where('admin_approval', 'pending')->first();
    $excludedFields = ["created_at", "updated_at", "created_by", "updated_by", "id", "user_id", "file_operating_license","file_1","file_2","file_3","minor_plant_code"];

    if(!$newData){
      return response()->json([
          "error"=>"no any pendig request found for edit",
          "status" => 400,
          "data"=> [],
          ],400);
    }

    foreach ($userDetail->getAttributes() as $key => $value) {
      if (!in_array($key, $excludedFields) && isset($newData->$key) && $userDetail->$key != $newData->$key) {
          $userDetail->$key = $newData->$key;
      }
    }

    if($user->accountType == 2 && isset($newData->file_operating_license) &&  $userDetail->file_operating_license != $newData->file_operating_license){
      if (Storage::exists($userDetail->file_operating_license)) {
       Storage::delete($userDetail->file_operating_license);
      } 
      $userDetail->file_operating_license = $newData->file_operating_license;
    }
    if($user->accountType == 1){  
      if(isset($newData->file_1) &&  $userDetail->file_1 != $newData->file_1){
         if (Storage::exists($userDetail->file_1)) {
           Storage::delete($userDetail->file_1);
        }  
        $userDetail->file_1 = $newData->file_1;
      }
      if(isset($newData->file_2) &&  $userDetail->file_2 != $newData->file_2){
          if (Storage::exists($userDetail->file_2)) {
            Storage::delete($userDetail->file_2);
        }  
        $userDetail->file_2 = $newData->file_2;
      }
      if(isset($newData->file_3) &&  $userDetail->file_3 != $newData->file_3){
        if (Storage::exists($userDetail->file_3)) {
          Storage::delete($userDetail->file_3);
        }  
        $userDetail->file_3 = $newData->file_3;
      }
      if(isset($newData->minor_plant_code) &&  $userDetail->minor_plant_code != $newData->minor_plant_code){
        if (Storage::exists($userDetail->minor_plant_code)) {
          Storage::delete($userDetail->minor_plant_code);
        }  
        $userDetail->minor_plant_code = $newData->minor_plant_code;
      }
    }
  
    $newData->admin_approval = "approved";
    $userDetail->save();
    $newData->save();

    //Set  profile_update_request to Not in  Users table
    $user->profile_update_request = "No";
    $user->save();
   
    // SEND MAIL to USER
    $to = $user->email;
    Mail::to($to)->send(new ProfileEditNotification("approved",null,$userDetail));

    return response()->json([
    "message"=>"New Edit Request of User is Approved",
    "status" => 200,
    "data"=> [],
  ],200);
  }

  public function rejectData(Request $request, $id){
    $user = User::where(['id' => $id])->first();
    $userDetail = UserDetail::where('user_id', $id)->first();
    $newData = UserDetailOldData::where('user_detail_id', $id)->where('admin_approval', 'pending')->first();

    if(!$newData){
      return response()->json([ 
          "error"=>"no any pendig request found for edit",
          "status" => 400,
          "data"=> [],
          ],400);
    }

    $newData->reject_reason =  $request->input('reject_reason');
    $newData->admin_approval = 'rejected';
    $newData->save();
    
    //Set  profile_update_request to Not in  Users table
    $user->profile_update_request = "No";
    $user->save();
       
    $to = $user->email;
    Mail::to($to)->send(new ProfileEditNotification("rejected",$newData->reject_reason,$userDetail));
    
    return response()->json([
    "message"=>"New Edit Request of User is Rejected",
    "status" => 200,
    "data"=> [],
  ],200);
  }
  
  public function showPdf($filename){
     $filePath = 'storage/'.storage_path($filename);

     return Response::make(file_get_contents($filePath,200,[
      "Content-Type" => "application/pdf",
      "Content-Disposition" => 'inline; filename="'.$filename.'"'
     ]));
        
    // return response()->file(storage_path($filePath));
  }
}
