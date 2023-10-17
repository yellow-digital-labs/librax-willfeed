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
  public function index()
  {
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
      $total_orders = Order::where([])->count();
      $pending_orders = Order::where([])
        ->where("order_status_id", "=", 1)
        ->count();
      $completed_orders = Order::where([])
        ->where("payment_status", "=", 'paid')
        ->count();

      $most_order_from_city = DB::table('orders')
        ->select('billing_region', DB::raw('SUM(total_payable_amount) as total_sales'), DB::raw('COUNT(id) as total_orders'))
        ->groupBy('billing_region')
        ->orderBy('total_sales', 'DESC')
        ->limit(4)
        ->get();

      $payment_method_wise_income = DB::table('orders')
        ->select('payment_method_name', DB::raw('SUM(total_payable_amount) as total_sales'), DB::raw('COUNT(id) as total_orders'))
        ->where("payment_status", "=", "paid")
        ->groupBy('payment_method_name')
        ->orderBy('total_sales', 'DESC')
        ->get();

      $top_selling_products = DB::table('orders')
        ->select('product_name', DB::raw('SUM(total_payable_amount) as total_sales'), DB::raw('COUNT(id) as total_orders'))
        ->where("order_status_id", "=", 2)
        ->groupBy('product_name')
        ->orderBy('total_sales', 'DESC')
        ->limit(5)
        ->get();

      $account_counts = User::select(DB::raw("COUNT(id) AS accounts"), 'accountType')->where("accountType", "<>", "0")->groupBy("accountType")->orderBy("accountType")->get();
      $total_accounts = User::where("accountType", "<>", "0")->count();
      $private_distributers = UserDetail::where('is_private_distributer', '=', 'Si')->groupBy('is_private_distributer')->count();
    } elseif($isBuyer) {
      $user_id = Auth::user()->id;

      $total_orders = Order::where("user_id", "=", $user_id)->count();
      $pending_orders = Order::where("user_id", "=", $user_id)
        ->where("order_status_id", "=", 1)
        ->count();
      $completed_orders = Order::where("user_id", "=", $user_id)
        ->where("payment_status", "=", 'paid')
        ->count();

      $approved_orders_amount = Order::where("user_id", "=", $user_id)
        ->where("order_status_id", "=", 2)
        ->groupBy("payment_status")
        ->sum("total_payable_amount");

      $approved_orders_paid_amount = Order::where("user_id", "=", $user_id)
        ->where("order_status_id", "=", 2)
        ->where("payment_status", "=", 'paid')
        ->groupBy("payment_status")
        ->sum("total_payable_amount");

      $approved_orders_unpaid_amount = Order::where("user_id", "=", $user_id)
        ->where("order_status_id", "=", 2)
        ->where("payment_status", "=", 'unpaid')
        ->groupBy("payment_status")
        ->sum("total_payable_amount");

      $top_selling_products = DB::table('orders')
        ->select('product_name', DB::raw('SUM(total_payable_amount) as total_sales'), DB::raw('COUNT(id) as total_orders'))
        ->where("user_id", "=", $user_id)
        ->where("order_status_id", "=", 2)
        ->groupBy('product_name')
        ->orderBy('total_sales', 'DESC')
        ->limit(5)
        ->get();

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

      if($approved_orders_amount>0){
        $approved_orders_paid_amount_per = $approved_orders_paid_amount * 100 / $approved_orders_amount;
        $approved_orders_unpaid_amount_per = $approved_orders_unpaid_amount * 100 / $approved_orders_amount;
      }
    } elseif($isSeller) {
      $user_id = Auth::user()->id;

      $total_orders = Order::where("seller_id", "=", $user_id)->count();
      $pending_orders = Order::where("seller_id", "=", $user_id)
        ->where("order_status_id", "=", 1)
        ->count();
      $completed_orders = Order::where("seller_id", "=", $user_id)
        ->where("payment_status", "=", 'paid')
        ->count();

      $most_order_from_city = DB::table('orders')
        ->select('billing_region', DB::raw('SUM(total_payable_amount) as total_sales'), DB::raw('COUNT(id) as total_orders'))
        ->where("seller_id", "=", $user_id)
        ->groupBy('billing_region')
        ->orderBy('total_sales', 'DESC')
        ->limit(4)
        ->get();

      $payment_method_wise_income = DB::table('orders')
        ->select('payment_method_name', DB::raw('SUM(total_payable_amount) as total_sales'), DB::raw('COUNT(id) as total_orders'))
        ->where("seller_id", "=", $user_id)
        ->where("payment_status", "=", "paid")
        ->groupBy('payment_method_name')
        ->orderBy('total_sales', 'DESC')
        ->get();

      $top_selling_products = DB::table('orders')
        ->select('product_name', DB::raw('SUM(total_payable_amount) as total_sales'), DB::raw('COUNT(id) as total_orders'))
        ->where("seller_id", "=", $user_id)
        ->where("order_status_id", "=", 2)
        ->groupBy('product_name')
        ->orderBy('total_sales', 'DESC')
        ->limit(5)
        ->get();

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

    return view('content.pages.pages-dashboard', [
      "isSeller" => $isSeller,
      "isAdmin" => $isAdmin,
      "isBuyer" => $isBuyer,
      "total_orders" => $total_orders,
      "pending_orders" => $pending_orders,
      "completed_orders" => $completed_orders,
      "most_order_from_city" => $most_order_from_city,
      "payment_method_wise_income" => $payment_method_wise_income,
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
    ]);
  }
}
