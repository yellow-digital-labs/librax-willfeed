<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSeller;
use App\Models\Product;
use App\Models\PaymentOption;
use App\Models\Region;
use App\Models\PaymentExtension;

class BuyerHome extends Controller
{
  public function index(Request $request)
  {
    $request = $request->all();
    // dd($request);
    
    $search = "";
    $is_user_details_joined = false;
    if(isset($request['search'])){
      $search = $request['search'];
    }
    $product_query = ProductSeller::where(["status" => "active"]);
    if($search){
      $product_query = $product_query
        ->where(function($query) use ($search){
          $query->whereRaw("product_name LIKE '%".$search."%' OR seller_name LIKE '%".$search."%'");
        });
    }
    if($request['price_min'] && $request['price_max']){
      $product_query = $product_query
        ->where("amount", ">=", $request['price_min'])
        ->where("amount", "<=", $request['price_max']);
    }
    if(isset($request['fuel_type']) && count($request['fuel_type'])){
      $product_query->where(function($query) use ($request){
        foreach($request['fuel_type'] as $fuel_type){
          $query->orWhere("product_name", $fuel_type);
        }
      });
    }
    //payment option
    // if(isset($request['payment_option']) && count($request['payment_option'])){
    //   foreach($request['payment_option'] as $payment_option){
    //     $product_query = $product_query
    //       ->leftJoin('user_details', 'user_details.seller_id', '=', 'product_sellers.seller_id')
    //       ->where("user_details.payment_extension", $payment_option);
    //   }
    // }
    if(isset($request['region']) && count($request['region'])){
      if(!$is_user_details_joined){
        $product_query = $product_query
          ->leftJoin('user_details', 'user_details.user_id', '=', 'product_sellers.seller_id');
        $is_user_details_joined = true;
      }
      $sub_query = "";
      $sep = "(";
      foreach($request['region'] as $region){
        $sub_query .= $sep."FIND_IN_SET(user_details.geographical_coverage_regions, '$region')";
        $sep = " OR ";
      }
      $sub_query .= ")";
      $product_query
        ->whereRaw($sub_query);
    }

    if(isset($request['payment_time']) && count($request['payment_time'])){
      if(!$is_user_details_joined){
        $product_query = $product_query
          ->leftJoin('user_details', 'user_details.user_id', '=', 'product_sellers.seller_id');
        $is_user_details_joined = true;
      }
      $product_query->where(function($query) use ($request){
        foreach($request['payment_time'] as $payment_time){
          $query->orWhere("user_details.payment_extension", $payment_time);
        }
      });
      $product_query
        ->whereRaw($sub_query);
    }

    //delivery time
    // $product_query->dd();
    $products_list = $product_query->paginate(5);

    $products = Product::where(["active" => "yes"])->get();
    $payment_options = PaymentOption::all();
    $regions = Region::all();
    $payment_extensions = PaymentExtension::all();

    return view('content.pages.pages-buyer-home', [
      "products_list" => $products_list,
      "products" => $products,
      "payment_options" => $payment_options,
      "regions" => $regions,
      "payment_extensions" => $payment_extensions,
      "search" => $search,
      "request" => $request,
    ]);
  }
}
