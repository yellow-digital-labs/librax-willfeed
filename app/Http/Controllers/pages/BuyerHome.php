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
    
    $search = "";
    if(isset($request['search'])){
      $search = $request['search'];
    }
    if($search){
      $products_list = ProductSeller::where(["status" => "active"])
        ->where(function($query) use ($search){
          $query->whereRaw("product_name LIKE '%".$search."%' OR seller_name LIKE '%".$search."%'");
        })->paginate(10);
    } else {
      $products_list = ProductSeller::where(["status" => "active"])->paginate(10);
    }

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
