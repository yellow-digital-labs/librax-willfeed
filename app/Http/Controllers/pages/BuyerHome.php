<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSeller;
use App\Models\Product;
use App\Models\PaymentOption;
use App\Models\Region;
use App\Models\PaymentExtension;
use App\Models\UserDetail;
use App\Helpers\Helpers;
use Auth;

class BuyerHome extends Controller
{
  public function index(Request $request)
  {
    $user = Auth::user();
    $isLoggedIn = false;
    $isAdmin = false;
    $isBuyer = false;
    $isSeller = false;
    if($user){
      $isLoggedIn = true;
      $isAdmin = Helpers::isAdmin();
      $isBuyer = Helpers::isBuyer();
      $isSeller = Helpers::isSeller();
    }
    $request = $request->all();
    // dd($request);
    
    $search = "";
    $is_user_details_joined = false;
    if(isset($request['search'])){
      $search = $request['search'];
    }
    if($isSeller){
      $product_query = UserDetail::selectRaw("user_details.*, users.*")->where(["users.approved_by_admin" => "Yes", "users.accountType" => 1])
        ->leftJoin("users", "users.id", "user_details.user_id");

      if($search){
        $product_query = $product_query
          ->where(function($query) use ($search){
            $query->whereRaw("user_details.business_name LIKE '%".addslashes($search)."%'");
          });
      }

      if(isset($request['fuel_type']) && count($request['fuel_type'])){
        $product_query->where(function($query) use ($request){
          foreach($request['fuel_type'] as $fuel_type){
            $query->orWhereRaw("FIND_IN_SET('".addslashes($fuel_type)."', user_details.products)");
          }
        });
      }

      if(isset($request['payment_option']) && count($request['payment_option'])){
        $product_query->where(function($query) use ($request){
          foreach($request['payment_option'] as $payment_option){
            $query->orWhere("user_details.payment_term", $payment_option);
          }
        });
      }

      if(isset($request['region']) && count($request['region'])){
        $product_query->where(function($query) use ($request){
          foreach($request['region'] as $region){
            $query->orWhere("user_details.region", addslashes($region));
          }
        });
      }

      if(isset($request['payment_time']) && count($request['payment_time'])){
        $product_query->where(function($query) use ($request){
          foreach($request['payment_time'] as $payment_time){
            $query->orWhere("user_details.payment_extension", addslashes($payment_time));
          }
        });
      }

      if($user){
        $product_query->leftJoin('customer_verifieds', function($join) use ($user, $product_query){
          $product_query->addSelect("customer_verifieds.status AS couldOrderStatus");
          $join->where('customer_verifieds.seller_id', '=', $user->id);
          $join->on('customer_verifieds.customer_id', '=', 'user_details.user_id');
        });
      }
    } else {
      $product_query = ProductSeller::where(["product_sellers.status" => "active"])
        ->select("product_sellers.*");

      $product_query = $product_query
        ->leftJoin('user_details', 'user_details.user_id', '=', 'product_sellers.seller_id')
        ->addSelect(["user_details.region", "user_details.main_activity_ids", "user_details.bank_transfer", "user_details.bank_check", "user_details.rib", "user_details.rid", "user_details.payment_extension"]);
      $is_user_details_joined = true;

      if($search){
        $product_query = $product_query
          ->where(function($query) use ($search){
            $query->whereRaw("product_sellers.product_name LIKE '%".addslashes($search)."%' OR product_sellers.seller_name LIKE '%".addslashes($search)."%'");
          });
      }
      if(isset($request['price_min']) && isset($request['price_max'])){
        $product_query = $product_query
          ->where("amount", ">=", $request['price_min'])
          ->where("amount", "<=", $request['price_max']);
      }
      if(isset($request['fuel_type']) && count($request['fuel_type'])){
        $product_query->where(function($query) use ($request){
          foreach($request['fuel_type'] as $fuel_type){
            $query->orWhere("product_name", addslashes($fuel_type));
          }
        });
      }
      //payment option
      if(isset($request['payment_option']) && count($request['payment_option'])){
        if(!$is_user_details_joined){
          $product_query = $product_query
            ->leftJoin('user_details', 'user_details.user_id', '=', 'product_sellers.seller_id');
          $is_user_details_joined = true;
        }
        $product_query->where(function($query) use ($request){
          foreach($request['payment_option'] as $payment_option){
            if($payment_option == "Bonifico Bancario"){
              $query->orWhere("user_details.bank_transfer", "<>", "");
            } else if($payment_option == "Assegno Bancario") {
              $query->orWhere("user_details.bank_check", "<>", "");
            } else if($payment_option == "RIBA") {
              $query->orWhere("user_details.rib", "=", "Si");
            } else if($payment_option == "RID") {
              $query->orWhere("user_details.rid", "=", "Si");
            }
          }
        });
      }
      if(isset($request['region']) && count($request['region'])){
        if(!$is_user_details_joined){
          $product_query = $product_query
            ->leftJoin('user_details', 'user_details.user_id', '=', 'product_sellers.seller_id');
          $is_user_details_joined = true;
        }
        $sub_query = "";
        $sep = "(";
        foreach($request['region'] as $region){
          $sub_query .= $sep."FIND_IN_SET('".addslashes($region)."', user_details.geographical_coverage_regions)";
          $sep = " OR ";
        }
        $sub_query .= ")";
        $product_query
          ->whereRaw($sub_query);
      }

      if(isset($request['payment_time']) && count($request['payment_time'])){
        $product_query->where(function($query) use ($request){
          foreach($request['payment_time'] as $payment_time){
            if($payment_time == "A vista"){
              $query->orWhereRaw("product_sellers.amount_before_tax > 0");
            } else if($payment_time == "30gg"){
              $query->orWhereRaw("product_sellers.amount_30gg > 0");
            } else if($payment_time == "60gg"){
              $query->orWhereRaw("product_sellers.amount_60gg > 0");
            } else if($payment_time == "90gg"){
              $query->orWhereRaw("product_sellers.amount_90gg > 0");
            }
          }
        });
      }

      //delivery time
      
      //check could able to order
      if($user){
        $product_query->leftJoin('customer_verifieds', function($join) use ($user, $product_query){
          $product_query->addSelect("customer_verifieds.status AS couldOrderStatus");
          $join->on('customer_verifieds.seller_id', '=', 'product_sellers.seller_id');
          $join->where('customer_verifieds.customer_id', '=', $user->id);
        });
      }
    }

    // $product_query->dd();
    $products_list = $product_query->paginate(5);

    $products_filter = Product::where(["active" => "yes"])->get();
    $products = ProductSeller::where(["status" => "active"])->orderBy("product_name", "ASC")->get();
    // $payment_options = PaymentOption::all();
    $payment_options = ["Bonifico Bancario", "Assegno Bancario", "RIBA", "RID"];
    $regions = Region::all();
    $payment_extensions = PaymentExtension::all();

    //get min max price value
    $price_arr = ProductSeller::where(["product_sellers.status" => "active"])
      ->where("amount", "<>", 0)
      ->selectRaw("MIN(amount) AS min_price, MAX(amount) AS max_price")
      ->first();

    return view('content.pages.pages-buyer-home', [
      "products_list" => $products_list,
      "products_filter" => $products_filter,
      "products" => $products,
      "payment_options" => $payment_options,
      "regions" => $regions,
      "payment_extensions" => $payment_extensions,
      "search" => $search,
      "request" => $request,
      "isAdmin" => $isAdmin,
      "isBuyer" => $isBuyer,
      "isSeller" => $isSeller,
      "price_min" => $price_arr->min_price,
      "price_max" => $price_arr->max_price,
    ]);
  }
}
