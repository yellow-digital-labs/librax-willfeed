<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Helpers\Helpers;
use Auth;
use Redirect;
use DB;

class Dashboard extends Controller
{
  public function index()
  {
    $isAdmin = Helpers::isAdmin();
    if($isAdmin){
      $total_orders = Order::where([])->count();
      $pending_orders = Order::where([])
        ->where("order_status_id", "=", 1)
        ->count();
      $completed_orders = Order::where([])
        ->where("order_status_id", "=", 5)
        ->count();

      $most_order_from_city = DB::table('orders')
        ->select('billing_region', DB::raw('SUM(total_payable_amount) as total_sales'), DB::raw('COUNT(id) as total_orders'))
        ->groupBy('billing_region')
        ->orderBy('total_sales', 'DESC')
        ->limit(4)
        ->get();

      $payment_method_wise_income = DB::table('orders')
        ->select('payment_method_name', DB::raw('SUM(total_payable_amount) as total_sales'), DB::raw('COUNT(id) as total_orders'))
        ->groupBy('payment_method_name')
        ->orderBy('total_sales', 'DESC')
        ->get();

      $top_selling_products = DB::table('orders')
        ->select('product_name', DB::raw('SUM(total_payable_amount) as total_sales'), DB::raw('COUNT(id) as total_orders'))
        ->groupBy('product_name')
        ->limit(5)
        ->orderBy('total_sales', 'DESC')
        ->get();
    } else {
      $user_id = Auth::user()->id;

      $total_orders = Order::where("seller_id", "=", $user_id)->count();
      $pending_orders = Order::where("seller_id", "=", $user_id)
        ->where("order_status_id", "=", 1)
        ->count();
      $completed_orders = Order::where("seller_id", "=", $user_id)
        ->where("order_status_id", "=", 5)
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
        ->groupBy('payment_method_name')
        ->orderBy('total_sales', 'DESC')
        ->get();

      $top_selling_products = DB::table('orders')
        ->select('product_name', DB::raw('SUM(total_payable_amount) as total_sales'), DB::raw('COUNT(id) as total_orders'))
        ->where("seller_id", "=", $user_id)
        ->groupBy('product_name')
        ->limit(5)
        ->orderBy('total_sales', 'DESC')
        ->get();
    }

    return view('content.pages.pages-dashboard', [
      "total_orders" => $total_orders,
      "pending_orders" => $pending_orders,
      "completed_orders" => $completed_orders,
      "most_order_from_city" => $most_order_from_city,
      "payment_method_wise_income" => $payment_method_wise_income,
      "top_selling_products" => $top_selling_products,
    ]);
  }
}
