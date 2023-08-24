<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderActivityHistory;
use App\Helpers\Helpers;
use Auth;
use Redirect;

class Orders extends Controller
{
  public function index()
  {
    $isAdmin = Helpers::isAdmin();
    $user_id = Auth::user()->id;

    if($isAdmin){
      $total_orders = Order::where([])->count();
      $total_orders_euro = Order::where([])->sum('total_payable_amount');
      $rejected_orders = Order::where(["order_status_id" => "3"])->count();
      $completed_orders = Order::where(["order_status_id" => "5"])->count();
    } else {
      $total_orders = Order::where(['seller_id' => $user_id])->count();
      $total_orders_euro = Order::where(['seller_id' => $user_id])->sum('total_payable_amount');
      $rejected_orders = Order::where(['seller_id' => $user_id, "order_status_id" => "3"])->count();
      $completed_orders = Order::where(['seller_id' => $user_id, "order_status_id" => "5"])->count();
    }

    $urlListOrderData = route("order-list");
    
    return view("content.pages.pages-orders", [
      'total_orders' => $total_orders,
      'total_orders_euro' => $total_orders_euro,
      'rejected_orders' => $rejected_orders,
      'completed_orders' => $completed_orders,
      'urlListOrderData' => $urlListOrderData,
    ]);
  }

  public function list(Request $request)
  {
    $isAdmin = Helpers::isAdmin();
    $user_id = Auth::user()->id;
    $columns = [
      1 => "id",
      2 => "user_name",
      3 => "product_name",
      4 => "product_qty",
      5 => "order_date",
      6 => "order_status",
      7 => "payment_status",
    ];

    $search = [];

    if($isAdmin){
      $f = Order::where([]);
    } else {
      $f = Order::where("seller_id", "=", $user_id);
    }
    $totalData = $f->count();

    $totalFiltered = $totalData;

    $limit = $request->input("length");
    $start = $request->input("start");
    $order = $columns[$request->input("order.0.column")];
    $dir = $request->input("order.0.dir");

    $applied_filters = [];
    foreach ($request->input("columns") as $col) {
      if (!empty($col["search"]["value"])) {
        $applied_filters[$col["data"]] = $col["search"]["value"];
      }
    }

    if (empty($request->input("search.value"))) {
      if (count($applied_filters) > 0) {
        if($isAdmin){
          $customersObj = Order::where([]);
        } else {
          $customersObj = Order::where("seller_id", "=", $user_id);
        }

        foreach ($applied_filters as $field => $search) {
          $customersObj->where($field, "LIKE", "%{$search}%");
        }

        $customers = $customersObj
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      } else {
        if($isAdmin){
          $customers = Order::where([])
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        } else {
          $customers = Order::where("seller_id", "=", $user_id)
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        }
      }
    } else {
      $search = $request->input("search.value");

      if($isAdmin){
        $q = Order::where(function ($query) {
          return $query
            ->where("user_name", "LIKE", "%{$search}%")
            ->orWhere("customer_region", "LIKE", "%{$search}%")
            ->orWhere("order_status", "LIKE", "%{$search}%")
            ->orWhere("payment_status", "LIKE", "%{$search}%");
        });
      } else {
        $q = Order::where("seller_id", "=", $user_id)
        ->where(function ($query) {
          return $query
            ->where("user_name", "LIKE", "%{$search}%")
            ->orWhere("customer_region", "LIKE", "%{$search}%")
            ->orWhere("order_status", "LIKE", "%{$search}%")
            ->orWhere("payment_status", "LIKE", "%{$search}%");
        });
      }
      $customers = $q
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();

      $totalFiltered = $q
        ->count();
    }

    $data = [];

    if (!empty($customers)) {
      // providing a dummy id instead of database ids
      $ids = $start;

      foreach ($customers as $customer) {
        $nestedData["id"] = $customer->id;
        $nestedData["fake_id"] = ++$ids;
        $nestedData["user_name"] = $customer->user_name;
        $nestedData["product_name"] = $customer->product_name;
        $nestedData["product_qty"] = $customer->product_qty." litri";
        $nestedData["order_date"] = $customer->order_date;
        $nestedData["order_status"] = $customer->order_status;
        $nestedData["payment_status"] = $customer->payment_status;

        $data[] = $nestedData;
      }
    }

    if ($data) {
      return response()->json([
        "draw" => intval($request->input("draw")),
        "recordsTotal" => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "code" => 200,
        "data" => $data,
      ]);
    } else {
      return response()->json([
        "message" => "Internal Server Error",
        "code" => 500,
        "data" => [],
      ]);
    }
  }

  public function detail(Request $request, $id)
  {
    $user_id = Auth::user()->id;

    $order = Order::where("id", "=", $id)
      ->where("seller_id", "=", $user_id)
      ->first();

    if($order){
      $customer_total_orders = Order::where("user_id", "=", $order->user_id)
        ->where("seller_id", "=", $user_id)
        ->count();

      $order_activity = OrderActivityHistory::where("order_id", "=", $id)->get();

      return view("content.pages.pages-order-details", [
        'id' => $id,
        'order' => $order,
        'customer_total_orders' => $customer_total_orders,
        'order_activity' => $order_activity,
      ]);
    } else {
      return redirect()->route('orders')->withErrors(['msg' => 'Invalid request']);
    }
  }

  public function status(Request $request, $id, $status){
    $user_id = Auth::user()->id;

    $order = Order::where("id", "=", $id)
      ->where("seller_id", "=", $user_id)
      ->first();

    if($order){
      $order->update([
        'order_status_id' => $status
      ]);
      
      return redirect()->route('order-details', ['id' => $id]);
    } else {
      return redirect()->route('orders')->withErrors(['msg' => 'Invalid request']);
    }
  }
}
