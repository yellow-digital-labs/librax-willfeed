<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\CustomerVerified;
use App\Helpers\Helpers;
use Auth;
use Redirect;
use DB;

class Dashboard extends Controller
{
  public function index(Request $request)
  {

    $filters = $request->all();
    $isOrderFilter = true;
    $isRevenueFilter = true;
    $isProductFilter = true;
    $isVendorFilter = true;
    $order_start_date = "2023-01-01";
    $order_end_date = date("Y-m-d");
    $revenue_start_date = "2023-01-01";
    $revenue_end_date = date("Y-m-d");
    $product_start_date = "2023-01-01";
    $product_end_date = date("Y-m-d");
    $vendor_start_date = "2023-01-01";
    $vendor_end_date = date("Y-m-d");
    if(count($filters)>0){
      if(isset($filters['orders_range'])){
        $isOrderFilter = true;
        $order_start_date = Helpers::getStartDateFromFilter($filters['orders_range']);
        $order_end_date = Helpers::getEndDateFromFilter($filters['orders_range']);
      }
      if(isset($filters['revenue_range'])){
        $isRevenueFilter = true;
        $revenue_start_date = Helpers::getStartDateFromFilter($filters['revenue_range']);
        $revenue_end_date = Helpers::getEndDateFromFilter($filters['revenue_range']);
      }
      if(isset($filters['product_range'])){
        $isProductFilter = true;
        $product_start_date = Helpers::getStartDateFromFilter($filters['product_range']);
        $product_end_date = Helpers::getEndDateFromFilter($filters['product_range']);
      }
      if(isset($filters['vendor_range'])){
        $isVendorFilter = true;
        $vendor_start_date = Helpers::getStartDateFromFilter($filters['vendor_range']);
        $vendor_end_date = Helpers::getEndDateFromFilter($filters['vendor_range']);
      }
    }
    
    $isAdmin = Helpers::isAdmin();
    $isSeller = Helpers::isSeller();
    $isBuyer = Helpers::isBuyer();

    $account_counts = [];
    $private_distributers = 0;
    $total_accounts = 0;
    $approved_orders_amount = 0;
    $approved_orders_paid_amount = 0;
    $approved_orders_unpaid_amount = 0;
    $approved_orders_paid_amount_per = 0;
    $approved_orders_unpaid_amount_per = 0;
    $payment_method_wise_income = [];
    $most_order_from_city = [];
    $total_vendor_conf_count = 0;
    $pending_vendor_conf_count = 0;
    $accept_vendor_conf_count = 0;
    $reject_vendor_conf_count = 0;
    if($isAdmin){
      if($isOrderFilter){
        $total_orders = Order::where([])
          ->where("created_at", ">=", $order_start_date)
          ->where("created_at", "<=", $order_end_date)
          ->count();
        $pending_orders = Order::where([])
          ->where("order_status_id", "=", 1)
          ->where("created_at", ">=", $order_start_date)
          ->where("created_at", "<=", $order_end_date)
          ->count();
        $completed_orders = Order::where([])
          ->where("payment_status", "=", 'paid')
          ->where("created_at", ">=", $order_start_date)
          ->where("created_at", "<=", $order_end_date)
          ->count();
      } else {
        $total_orders = Order::where([])->count();
        $pending_orders = Order::where([])
          ->where("order_status_id", "=", 1)
          ->count();
        $completed_orders = Order::where([])
          ->where("payment_status", "=", 'paid')
          ->count();
      }

      if($isRevenueFilter){
        $approved_orders_amount = Order::where("order_status_id", "=", 2)
          ->where("created_at", ">=", $revenue_start_date)
          ->where("created_at", "<=", $revenue_end_date)
          ->groupBy("payment_status")
          ->sum("total_payable_amount");

        $approved_orders_paid_amount = Order::where("payment_status", "=", 'paid')
          ->where("created_at", ">=", $revenue_start_date)
          ->where("created_at", "<=", $revenue_end_date)
          ->groupBy("payment_status")
          ->sum("total_payable_amount");

        $approved_orders_unpaid_amount = Order::where("order_status_id", "=", 4)
          ->where("payment_status", "=", 'unpaid')
          ->where("created_at", ">=", $revenue_start_date)
          ->where("created_at", "<=", $revenue_end_date)
          ->groupBy("payment_status")
          ->sum("total_payable_amount");
      } else {
        $approved_orders_amount = Order::where("order_status_id", "=", 2)
          ->groupBy("payment_status")
          ->sum("total_payable_amount");

        $approved_orders_paid_amount = Order::where("payment_status", "=", 'paid')
          ->groupBy("payment_status")
          ->sum("total_payable_amount");

        $approved_orders_unpaid_amount = Order::where("order_status_id", "=", 4)
          ->where("payment_status", "=", 'unpaid')
          ->groupBy("payment_status")
          ->sum("total_payable_amount");
      }

      if($isProductFilter){
        $top_selling_products = DB::table('orders')
          ->select('product_id', 'product_name', DB::raw('SUM(total_payable_amount) as total_sales'), DB::raw('COUNT(id) as total_orders'))
          ->where("order_status_id", "=", 2)
          ->where("created_at", ">=", $product_start_date)
          ->where("created_at", "<=", $product_end_date)
          ->groupBy('product_name')
          ->orderBy('total_sales', 'DESC')
          ->limit(5)
          ->get();
      } else {
        $top_selling_products = DB::table('orders')
          ->select('product_id', 'product_name', DB::raw('SUM(total_payable_amount) as total_sales'), DB::raw('COUNT(id) as total_orders'))
          ->where("order_status_id", "=", 2)
          ->groupBy('product_name')
          ->orderBy('total_sales', 'DESC')
          ->limit(5)
          ->get();
      }

      if($isVendorFilter){
        $account_counts = User::select(DB::raw("COUNT(id) AS accounts"), 'accountType')
          ->where("accountType", "<>", "0")
          ->where("created_at", ">=", $vendor_start_date)
          ->where("created_at", "<=", $vendor_end_date)
          ->groupBy("accountType")
          ->orderBy("accountType")
          ->get();
        $total_accounts = User::where("accountType", "<>", "0")
          ->where("created_at", ">=", $vendor_start_date)
          ->where("created_at", "<=", $vendor_end_date)
          ->count();
        $private_distributers = UserDetail::where('is_private_distributer', '=', 'Si')
          ->where("created_at", ">=", $vendor_start_date)
          ->where("created_at", "<=", $vendor_end_date)
          ->groupBy('is_private_distributer')
          ->count();
      } else {
        $account_counts = User::select(DB::raw("COUNT(id) AS accounts"), 'accountType')
          ->where("accountType", "<>", "0")
          ->groupBy("accountType")
          ->orderBy("accountType")
          ->get();
        $total_accounts = User::where("accountType", "<>", "0")
          ->count();
        $private_distributers = UserDetail::where('is_private_distributer', '=', 'Si')
          ->groupBy('is_private_distributer')
          ->count();
      }
    } elseif($isBuyer) {
      $user_id = Auth::user()->id;

      if($isOrderFilter){
        $total_orders = Order::where("user_id", "=", $user_id)
          ->where("created_at", ">=", $order_start_date)
          ->where("created_at", "<=", $order_end_date)
          ->count();
        $pending_orders = Order::where("user_id", "=", $user_id)
          ->where("order_status_id", "=", 1)
          ->count();
        $completed_orders = Order::where("user_id", "=", $user_id)
          ->where("payment_status", "=", 'paid')
          ->count();
      } else {
        $total_orders = Order::where("user_id", "=", $user_id)->count();
        $pending_orders = Order::where("user_id", "=", $user_id)
          ->where("order_status_id", "=", 1)
          ->count();
        $completed_orders = Order::where("user_id", "=", $user_id)
          ->where("payment_status", "=", 'paid')
          ->count();
      }

      if($isRevenueFilter){
        $approved_orders_amount = Order::where("user_id", "=", $user_id)
          ->where("order_status_id", "=", 2)
          ->where("created_at", ">=", $revenue_start_date)
          ->where("created_at", "<=", $revenue_end_date)
          ->groupBy("payment_status")
          ->sum("total_payable_amount");

        $approved_orders_paid_amount = Order::where("user_id", "=", $user_id)
          ->where("payment_status", "=", 'paid')
          ->where("created_at", ">=", $revenue_start_date)
          ->where("created_at", "<=", $revenue_end_date)
          ->groupBy("payment_status")
          ->sum("total_payable_amount");

        $approved_orders_unpaid_amount = Order::where("user_id", "=", $user_id)
          ->where("order_status_id", "=", 4)
          ->where("payment_status", "=", 'unpaid')
          ->where("created_at", ">=", $revenue_start_date)
          ->where("created_at", "<=", $revenue_end_date)
          ->groupBy("payment_status")
          ->sum("total_payable_amount");
      } else {
        $approved_orders_amount = Order::where("user_id", "=", $user_id)
          ->where("order_status_id", "=", 2)
          ->groupBy("payment_status")
          ->sum("total_payable_amount");

        $approved_orders_paid_amount = Order::where("user_id", "=", $user_id)
          ->where("payment_status", "=", 'paid')
          ->groupBy("payment_status")
          ->sum("total_payable_amount");

        $approved_orders_unpaid_amount = Order::where("user_id", "=", $user_id)
          ->where("order_status_id", "=", 4)
          ->where("payment_status", "=", 'unpaid')
          ->groupBy("payment_status")
          ->sum("total_payable_amount");
      }

      if($isProductFilter){
        $top_selling_products = DB::table('orders')
          ->select('product_id', 'product_name', DB::raw('SUM(total_payable_amount) as total_sales'), DB::raw('COUNT(id) as total_orders'))
          ->where("user_id", "=", $user_id)
          ->where("order_status_id", "=", 2)
          ->where("created_at", ">=", $product_start_date)
          ->where("created_at", "<=", $product_end_date)
          ->groupBy('product_name')
          ->orderBy('total_sales', 'DESC')
          ->limit(5)
          ->get();
      } else {
        $top_selling_products = DB::table('orders')
          ->select('product_id', 'product_name', DB::raw('SUM(total_payable_amount) as total_sales'), DB::raw('COUNT(id) as total_orders'))
          ->where("user_id", "=", $user_id)
          ->where("order_status_id", "=", 2)
          ->groupBy('product_name')
          ->orderBy('total_sales', 'DESC')
          ->limit(5)
          ->get();
      }

      $venders_count_by_status = CustomerVerified::where("customer_id", "=", $user_id)
        ->select(DB::raw("COUNT(id) AS counts"), "status")
        ->groupBy("status")
        ->get();

      
      foreach($venders_count_by_status as $_venders_count_by_status){
        $total_vendor_conf_count = $_venders_count_by_status->counts;
        if($_venders_count_by_status->status == "pending"){
          $pending_vendor_conf_count = $_venders_count_by_status->counts;
        } elseif($_venders_count_by_status->status == "approved") {
          $accept_vendor_conf_count = $_venders_count_by_status->counts;
        } elseif($_venders_count_by_status->status == "rejected") {
          $reject_vendor_conf_count = $_venders_count_by_status->counts;
        }
      }
    } elseif($isSeller) {
      $user_id = Auth::user()->id;

      if($isOrderFilter){
        $total_orders = Order::where("seller_id", "=", $user_id)
          ->where("created_at", ">=", $order_start_date)
          ->where("created_at", "<=", $order_end_date)
          ->count();
        $pending_orders = Order::where("seller_id", "=", $user_id)
          ->where("created_at", ">=", $order_start_date)
          ->where("created_at", "<=", $order_end_date)
          ->where("order_status_id", "=", 1)
          ->count();
        $completed_orders = Order::where("seller_id", "=", $user_id)
          ->where("created_at", ">=", $order_start_date)
          ->where("created_at", "<=", $order_end_date)
          ->where("payment_status", "=", 'paid')
          ->count();
      } else {
        $total_orders = Order::where("seller_id", "=", $user_id)->count();
        $pending_orders = Order::where("seller_id", "=", $user_id)
          ->where("order_status_id", "=", 1)
          ->count();
        $completed_orders = Order::where("seller_id", "=", $user_id)
          ->where("payment_status", "=", 'paid')
          ->count();
      }

      if($isRevenueFilter){
        $approved_orders_amount = Order::where("seller_id", "=", $user_id)
          ->where("order_status_id", "=", 2)
          ->where("created_at", ">=", $revenue_start_date)
          ->where("created_at", "<=", $revenue_end_date)
          ->groupBy("payment_status")
          ->sum("total_payable_amount");

        $approved_orders_paid_amount = Order::where("seller_id", "=", $user_id)
          ->where("payment_status", "=", 'paid')
          ->where("created_at", ">=", $revenue_start_date)
          ->where("created_at", "<=", $revenue_end_date)
          ->groupBy("payment_status")
          ->sum("total_payable_amount");

        $approved_orders_unpaid_amount = Order::where("seller_id", "=", $user_id)
          ->where("order_status_id", "=", 4)
          ->where("payment_status", "=", 'unpaid')
          ->where("created_at", ">=", $revenue_start_date)
          ->where("created_at", "<=", $revenue_end_date)
          ->groupBy("payment_status")
          ->sum("total_payable_amount");
      } else {
        $approved_orders_amount = Order::where("seller_id", "=", $user_id)
          ->where("order_status_id", "=", 2)
          ->groupBy("payment_status")
          ->sum("total_payable_amount");

        $approved_orders_paid_amount = Order::where("seller_id", "=", $user_id)
          ->where("payment_status", "=", 'paid')
          ->groupBy("payment_status")
          ->sum("total_payable_amount");

        $approved_orders_unpaid_amount = Order::where("seller_id", "=", $user_id)
          ->where("order_status_id", "=", 4)
          ->where("payment_status", "=", 'unpaid')
          ->groupBy("payment_status")
          ->sum("total_payable_amount");
      }

      if($isProductFilter){
        $top_selling_products = DB::table('orders')
          ->select('product_id', 'product_name', DB::raw('SUM(total_payable_amount) as total_sales'), DB::raw('COUNT(id) as total_orders'))
          ->where("seller_id", "=", $user_id)
          ->where("order_status_id", "=", 2)
          ->where("created_at", ">=", $product_start_date)
          ->where("created_at", "<=", $product_end_date)
          ->groupBy('product_name')
          ->orderBy('total_sales', 'DESC')
          ->limit(5)
          ->get();
      } else {
        $top_selling_products = DB::table('orders')
          ->select('product_id', 'product_name', DB::raw('SUM(total_payable_amount) as total_sales'), DB::raw('COUNT(id) as total_orders'))
          ->where("seller_id", "=", $user_id)
          ->where("order_status_id", "=", 2)
          ->groupBy('product_name')
          ->orderBy('total_sales', 'DESC')
          ->limit(5)
          ->get();
      }

      $venders_count_by_status = CustomerVerified::where("seller_id", "=", $user_id)
        ->select(DB::raw("COUNT(id) AS counts"), "status")
        ->groupBy("status")
        ->get();

      
      foreach($venders_count_by_status as $_venders_count_by_status){
        $total_vendor_conf_count = $_venders_count_by_status->counts;
        if($_venders_count_by_status->status == "pending"){
          $pending_vendor_conf_count = $_venders_count_by_status->counts;
        } elseif($_venders_count_by_status->status == "approved") {
          $accept_vendor_conf_count = $_venders_count_by_status->counts;
        } elseif($_venders_count_by_status->status == "rejected") {
          $reject_vendor_conf_count = $_venders_count_by_status->counts;
        }
      }
    }

    $total_sell_from_top_selling = 0;
    foreach($top_selling_products as $top_selling_product){
      $total_sell_from_top_selling += $top_selling_product->total_sales;
    }

    $total_payment_method_wise_income = 0;
    foreach($payment_method_wise_income as $_payment_method_wise_income){
      $total_payment_method_wise_income += $_payment_method_wise_income->total_sales;
    }

    if($approved_orders_paid_amount+$approved_orders_unpaid_amount>0){
      $approved_orders_paid_amount_per = $approved_orders_paid_amount * 100 / ($approved_orders_paid_amount+$approved_orders_unpaid_amount);
      $approved_orders_unpaid_amount_per = $approved_orders_unpaid_amount * 100 / ($approved_orders_paid_amount+$approved_orders_unpaid_amount);
    }

    return view('content.pages.pages-dashboard', [
      "isSeller" => $isSeller,
      "isAdmin" => $isAdmin,
      "isBuyer" => $isBuyer,
      "total_orders" => $total_orders,
      "pending_orders" => $pending_orders,
      "completed_orders" => $completed_orders,
      "top_selling_products" => $top_selling_products,
      "total_sell_from_top_selling" => $total_sell_from_top_selling,
      "total_payment_method_wise_income" => $total_payment_method_wise_income,
      "account_counts" => $account_counts,
      "private_distributers" => $private_distributers,
      "total_accounts" => $total_accounts,
      "approved_orders_amount" => $approved_orders_amount,
      "approved_orders_paid_amount" => $approved_orders_paid_amount,
      "approved_orders_unpaid_amount" => $approved_orders_unpaid_amount,
      "approved_orders_paid_amount_per" => $approved_orders_paid_amount_per,
      "approved_orders_unpaid_amount_per" => $approved_orders_unpaid_amount_per,
      "total_vendor_conf_count" => $total_vendor_conf_count,
      "pending_vendor_conf_count" => $pending_vendor_conf_count,
      "accept_vendor_conf_count" => $accept_vendor_conf_count,
      "reject_vendor_conf_count" => $reject_vendor_conf_count,
      "order_start_date" => $order_start_date,
      "order_end_date" => $order_end_date,
      "revenue_start_date" => $revenue_start_date,
      "revenue_end_date" => $revenue_end_date,
      "product_start_date" => $product_start_date,
      "product_end_date" => $product_end_date,
      "vendor_start_date" => $vendor_start_date,
      "vendor_end_date" => $vendor_end_date,
    ]);
  }
}
