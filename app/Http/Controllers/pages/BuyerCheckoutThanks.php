<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Auth;

class BuyerCheckoutThanks extends Controller
{
  public function index($order_id)
  {
    if($order_id){
      $user = Auth::user();

      $order = Order::where([
        "id" => $order_id,
        "user_id" => $user->id
      ])->first();

      if($order){
        return view('content.pages.pages-buyer-checkout-thanks', [
          "order" => $order
        ]);
      } else {
        
      }
    } else {

    }
  }
}
