<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\ProductSeller;
use App\Models\Order;
use App\Models\User;
use App\Mail\OrderNewNotification;
use Auth;

class BuyerCheckout extends Controller
{
  public function index($seller_product_id)
  {
    $product = ProductSeller::where("id", $seller_product_id)->first();

    if($product) {
      return view('content.pages.pages-buyer-checkout', [
        "product" => $product
      ]);
    } else {
      return Redirect::back()->withErrors([
        "msg" => "Invalid request",
      ]);
    }
  }

  public function store(Request $request, $seller_product_id){
    $user = Auth::user();
    if($seller_product_id==$request->seller_product_id){
      $seller_product = ProductSeller::where(["id" => $seller_product_id])->first();
      $order = Order::create([
        "user_id" => $user->id,
        "seller_id" => $seller_product->seller_id,
        "product_id" => $seller_product->product_id,
        "product_amount" => $seller_product->amount_before_tax,
        "product_qty" => $request->product_qty,
        "total_payable_amount" => $request->amount * $request->product_qty,
        "order_date" => date("Y-m-d"),
        "customer_email" => $request->customer_email,
        "customer_contact" => $request->customer_contact,
        "shipping_address_line_1" => $request->shipping_address_line_1,
        "shipping_city" => $request->shipping_city,
        "shipping_zip" => $request->shipping_zip,
        "billing_address_line_1" => $request->billing_address_line_1,
        "billing_city" => $request->billing_city,
        "billing_zip" => $request->billing_zip,
      ]);
      
      //order details
      $order_details = Order::where("id", $order->id)->first();
      //send email
      $seller = User::where("id", $seller_product->seller_id)->first();
      Mail::to($seller->email)->send(new OrderNewNotification([
          "order_id" => $order->id,
          "product_name" => $order_details->product_name,
          "qty" => $request->product_qty,
          "url" => route("orders")
      ]));

      return redirect()->route('pages-buyer-checkout-thanks', [
        "order_id" => $order->id
      ]);
    } else {
      return Redirect::back()->withErrors([
        "msg" => "Invalid request",
      ]);
    }
  }
}
