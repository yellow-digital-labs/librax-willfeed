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

class SignupSeller extends Controller
{
  public function index()
  {
    $authUser = Auth::user();

    $user = User::find($authUser->id);
    if($user->accountType != 2 || $user->profile_completed != 'No'){ //if not seller or profile already completed
      //redirect to home page
      return redirect()->route('dashboard');
    }

    $main_activity = MainActivity::all();
    $common = Common::all();
    $province = Province::all();
    $storage_capacity = StorageCapacity::all();
    $order_capacity = OrderCapacity::all();
    $product = Product::all();
    $region = Region::all();

    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.pages.pages-signup-seller', [
      'pageConfigs' => $pageConfigs,
      'main_activity' => $main_activity,
      'common' => $common,
      'province' => $province,
      'storage_capacity' => $storage_capacity,
      'order_capacity' => $order_capacity,
      'product' => $product,
      'region' => $region,
    ]);
  }
}
