<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Auth;

class Dashboard extends Controller
{
  public function index()
  {
    $user_id = Auth::user()->id;

    $total_orders = Order::where("user_id", "=", $user_id)->count();
    $pending_orders = Order::where("user_id", "=", $user_id)
      ->where("order_status_id", "=", 1)
      ->count();
    $completed_orders = Order::where("user_id", "=", $user_id)
      ->where("order_status_id", "=", 5)
      ->count();

    return view('content.pages.pages-dashboard', [
      "total_orders" => $total_orders,
      "pending_orders" => $pending_orders,
      "completed_orders" => $completed_orders,
    ]);
  }
}
