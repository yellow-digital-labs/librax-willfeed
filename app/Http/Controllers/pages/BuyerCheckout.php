<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Helpers\Helpers;
use App\Models\ProductSeller;
use App\Models\Order;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\CustomerVerified;
use App\Models\Region;
use App\Models\Common;
use App\Models\Province;
use App\Mail\OrderNewNotification;
use Auth;

class BuyerCheckout extends Controller
{
  public function index($seller_product_id)
  {
    $user = Auth::user();
    
    $product = ProductSeller::where("id", $seller_product_id)->first();

    if($product) {

      $record = CustomerVerified::where([
        "seller_id" => $product->seller_id,
        "customer_id" => $user->id
      ]);

      $record_data = $record->first();
      if($record_data){
        //update
        if($record_data->status == "approved"){
          $user_details = UserDetail::where(["user_id" => $user->id])->first();
          $seller_details = UserDetail::where(["user_id" => $product->seller_id])->first();
          $region = Region::orderBy('name', 'ASC')->get();
          $common = Common::orderBy('name', 'ASC')->get();
          $province = Province::orderBy('name', 'ASC')->get();

          return view('content.pages.pages-buyer-checkout', [
            "product" => $product,
            "user" => $user,
            "user_details" => $user_details,
            "seller_details" => $seller_details,
            "region" => $region,
            "common" => $common,
            "province" => $province,
          ]);
        } else {
          return redirect()->route('customer-unauthorized', [
            "seller_id" => $product->seller_id
          ]);
        }
      } else {
        return redirect()->route('customer-unauthorized', [
          "seller_id" => $product->seller_id
        ]);
      }
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

      $record = CustomerVerified::where([
        "seller_id" => $seller_product->seller_id,
        "customer_id" => $user->id
      ]);

      $record_data = $record->first();
      if($record_data){
        //update
        if($record_data->status == "approved"){
          $seller_details = UserDetail::where(["user_id" => $seller_product->seller_id])->first();
          $amount_before_tax = 0;
          if($request->product_price_type=="A vista"){
            $amount_before_tax = $seller_product->amount_before_tax;
          } elseif($request->product_price_type=="30gg"){
            $amount_before_tax = $seller_product->amount_30gg;
          } elseif($request->product_price_type=="60gg"){
            $amount_before_tax = $seller_product->amount_60gg;
          } elseif($request->product_price_type=="90gg"){
            $amount_before_tax = $seller_product->amount_90gg;
          }

          $payment_method = "";
          if($request->payment_method == "bank_transfer"){
            $payment_method = "Bonifico";
          } elseif($request->payment_method == "rib"){
            $payment_method = "RIBA";
          } elseif($request->payment_method == "rid"){
            $payment_method = "RID";
          } elseif($request->payment_method == "bank_check"){
            $payment_method = "Assegno";
          }

          $total_payable_amount = ($amount_before_tax * $request->product_qty) + ($amount_before_tax * $request->product_qty*22/100);
          $order = Order::create([
            "user_id" => $user->id,
            "seller_id" => $seller_product->seller_id,
            "product_id" => $seller_product->product_id,
            "product_amount" => $amount_before_tax,
            "product_qty" => $request->product_qty,
            "total_payable_amount" => $total_payable_amount,
            "order_date" => date("Y-m-d"),
            "billing_first_name" => $request->billing_first_name,
            "billing_address" => $request->billing_address,
            "billing_house_no" => $request->billing_house_no,
            "billing_region" => $request->billing_region,
            "billing_province" => $request->billing_province,
            "billing_common" => $request->billing_common,
            "billing_pincode" => $request->billing_pincode,
            "billing_email" => $request->billing_email,
            "billing_contact" => $request->billing_contact,
            "selling_first_name" => $request->selling_first_name,
            "selling_address" => $request->selling_address,
            "selling_house_no" => $request->selling_house_no,
            "selling_region" => $request->selling_region,
            "selling_province" => $request->selling_province,
            "selling_common" => $request->selling_common,
            "selling_pincode" => $request->selling_pincode,
            "selling_email" => $request->selling_email,
            "selling_contact" => $request->selling_contact,
            "payment_option" => $request->product_price_type,
            "payment_method_name" => $payment_method,
            "est_delivery_date" => Helpers::calculateEstimateShippingDate($seller_product->delivery_time, $seller_product->delivery_days, $seller_product->days_off),
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
          return redirect()->route('customer-unauthorized', [
            "seller_id" => $seller_product->seller_id
          ]);
        }
      } else {
        return redirect()->route('customer-unauthorized', [
          "seller_id" => $seller_product->seller_id
        ]);
      }
    } else {
      return Redirect::back()->withErrors([
        "msg" => "Invalid request",
      ]);
    }
  }

  public function customerRequest(Request $request, $seller_id){
    $user = Auth::user();
    if($user){
      $record = CustomerVerified::where([
        "seller_id" => $seller_id,
        "customer_id" => $user->id
      ]);

      $record_data = $record->first();
      if($record_data){
        //update
        if($record_data->status == "pending"){
          return redirect()->route('customer-request-to-seller-thanks', [
            "seller_id" => $seller_id
          ]);
        } else {
          $record->update([
            "status" => "pending"
          ]);

          return redirect()->route('customer-request-to-seller-thanks', [
            "seller_id" => $seller_id
          ]);
        }
      } else {
        //insert
        CustomerVerified::create([
          "seller_id" => $seller_id,
          "customer_id" => $user->id
        ]);

        return redirect()->route('customer-request-to-seller-thanks', [
          "seller_id" => $seller_id
        ]);
      }
    } else {
      return response()->json([
        "message" => "You are not authorized",
        "code" => 500,
        "data" => [],
      ]);
    }
  }

  public function customerRequestThanks($seller_id){
    $user = Auth::user();
    if($user){
      $record = CustomerVerified::where([
        "seller_id" => $seller_id,
        "customer_id" => $user->id
      ]);
      $record_data = $record->first();
      if($record_data){
        if($record_data->status == "pending"){
          return view('content.pages.customer-request', []);
        } else {
          return redirect()->route('pages-buyer-home', [])->withErrors([
            "msg" => "Invalid request",
          ]);
        }
      } else {
        return redirect()->route('pages-buyer-home', [])->withErrors([
          "msg" => "Invalid request",
        ]);
      }
    } else {
      return redirect()->route('pages-buyer-home', [])->withErrors([
        "msg" => "Invalid request",
      ]);
    }
  }

  public function customerUnauthorized($seller_id){
    return view('content.pages.customer-unauthorized', []);
  }
}
