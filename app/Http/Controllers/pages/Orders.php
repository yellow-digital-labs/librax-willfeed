<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Order;
use App\Models\OrderActivityHistory;
use App\Models\PaymentOption;
use App\Models\OrderPayment;
use App\Models\User;
use App\Helpers\Helpers;
use App\Mail\OrderApprove;
use App\Mail\OrderReject;
use Auth;
use Redirect;

class Orders extends Controller
{
  public function index()
  {
    $isAdmin = Helpers::isAdmin();
    $isBuyer = Helpers::isBuyer();
    $user_id = Auth::user()->id;
    if($isAdmin){
      $total_orders = Order::where([])->count();
      $total_orders_euro = Order::where([])->sum('total_payable_amount');
      $rejected_orders = Order::where(["order_status_id" => "3"])->count();
      $completed_orders = Order::where(["payment_status" => "paid"])->count();
    } else {
      if(Helpers::isSeller()){
        $total_orders = Order::where(['seller_id' => $user_id])->count();
        $total_orders_euro = Order::where(['seller_id' => $user_id])->sum('total_payable_amount');
        $rejected_orders = Order::where(['seller_id' => $user_id, "order_status_id" => "3"])->count();
        $completed_orders = Order::where(['seller_id' => $user_id, "payment_status" => "paid"])->count();
      } else {
        $total_orders = Order::where(['user_id' => $user_id])->count();
        $total_orders_euro = Order::where(['user_id' => $user_id])->sum('total_payable_amount');
        $rejected_orders = Order::where(['user_id' => $user_id, "order_status_id" => "3"])->count();
        $completed_orders = Order::where(['user_id' => $user_id, "payment_status" => "paid"])->count();
      }
    }

    $urlListOrderData = route("order-list");
    
    return view("content.pages.pages-orders", [
      'isAdmin' => $isAdmin,
      'isBuyer' => $isBuyer,
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
    $isBuyer = Helpers::isBuyer();
    $user_id = Auth::user()->id;
    if($isAdmin){
      $columns = [
        0 => "seller_name",
        1 => "user_name",
        2 => "product_name",
        3 => "product_qty",
        4 => "order_date",
        5 => "order_status",
        6 => "payment_status",
      ];
    } else {
      if(!$isBuyer){
        $columns = [
          0 => "user_name",
          1 => "product_name",
          2 => "product_qty",
          3 => "order_date",
          4 => "order_status",
          5 => "payment_status",
        ];
      } else {
        $columns = [
          0 => "seller_name",
          1 => "product_name",
          2 => "product_qty",
          3 => "order_date",
          4 => "order_status",
          5 => "payment_status",
        ];
      }
    }

    $search = [];

    if($isAdmin){
      $f = Order::where([]);
    } else {
      if(Helpers::isSeller()){
        $f = Order::where("seller_id", "=", $user_id);
      } else {
        $f = Order::where("user_id", "=", $user_id);
      }
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
          if(Helpers::isSeller()){
            $customersObj = Order::where("seller_id", "=", $user_id);
          } else {
            $customersObj = Order::where("user_id", "=", $user_id);
          }
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
          if(Helpers::isSeller()){
            $customers = Order::where("seller_id", "=", $user_id)
              ->offset($start)
              ->limit($limit)
              ->orderBy($order, $dir)
              ->get();
          } else {
            $customers = Order::where("user_id", "=", $user_id)
              ->offset($start)
              ->limit($limit)
              ->orderBy($order, $dir)
              ->get();
          }
        }
      }
    } else {
      $search = $request->input("search.value");

      if($isAdmin){
        $q = Order::where(function ($query) use ($search) {
          return $query
            ->where("seller_name", "LIKE", "%{$search}%")
            ->orWhere("user_name", "LIKE", "%{$search}%")
            ->orWhere("product_name", "LIKE", "%{$search}%")
            ->orWhere("order_status", "LIKE", "%{$search}%")
            ->orWhere("payment_status", "LIKE", "%{$search}%");
        });
      } else {
        if(Helpers::isSeller()){
          $q = Order::where("seller_id", "=", $user_id)
          ->where(function ($query) use ($search) {
            return $query
              ->where("user_name", "LIKE", "%{$search}%")
              ->orWhere("product_name", "LIKE", "%{$search}%")
              ->orWhere("order_status", "LIKE", "%{$search}%")
              ->orWhere("payment_status", "LIKE", "%{$search}%");
          });
        } else {
          $q = Order::where("user_id", "=", $user_id)
          ->where(function ($query) use ($search) {
            return $query
              ->where("seller_name", "LIKE", "%{$search}%")
              ->orWhere("product_name", "LIKE", "%{$search}%")
              ->orWhere("order_status", "LIKE", "%{$search}%")
              ->orWhere("payment_status", "LIKE", "%{$search}%");
          });
        }
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
        $nestedData["seller_name"] = $customer->seller_name;
        $nestedData["user_name"] = $customer->user_name;
        $nestedData["product_name"] = $customer->product_name;
        $nestedData["product_qty"] = $customer->product_qty." litri";
        $nestedData["order_date"] = date('d-m-Y H:i', strtotime($customer->order_date));
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
    $isAdmin = Helpers::isAdmin();
    $isSeller = Helpers::isSeller();
    $user_id = Auth::user()->id;

    if($isAdmin){
      $order = Order::where("id", "=", $id)
        ->first();
    } else {
      if($isSeller){
        $order = Order::where("id", "=", $id)
          ->where("seller_id", "=", $user_id)
          ->first();
      } else {
        $order = Order::where("id", "=", $id)
          ->where("user_id", "=", $user_id)
          ->first();
      }
    }

    if($order){
      $customer_total_orders = Order::where("user_id", "=", $order->user_id)
        ->where("seller_id", "=", $order->seller_id)
        ->count();

      $order_activity = OrderActivityHistory::where("order_id", "=", $id)->get();
      $payment_options = PaymentOption::all();
      $payment_history = OrderPayment::where([
        "order_id" => $id
      ])->get();

      return view("content.pages.pages-order-details", [
        'id' => $id,
        'order' => $order,
        'customer_total_orders' => $customer_total_orders,
        'order_activity' => $order_activity,
        'isAdmin' => $isAdmin,
        'isSeller' => $isSeller,
        'payment_options' => $payment_options,
        'payment_history' => $payment_history,
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

      $buyer = User::where("id", $order->user_id)->first();
      if($status == "2"){ //Approved
        Mail::to($buyer->email)->send(new OrderApprove([
            "order_id" => $order->id,
            "url" => route("order-details", [
              "id" => $order->id
            ])
        ]));
      } else if($status == "3"){ // Rejected
        Mail::to($buyer->email)->send(new OrderReject([
            "order_id" => $order->id,
            "url" => route("order-details", [
              "id" => $order->id
            ])
        ]));
      }
      
      return redirect()->route('order-details', ['id' => $id]);
    } else {
      return redirect()->route('orders')->withErrors(['msg' => 'Invalid request']);
    }
  }

  public function payment(Request $request, $id){
    $user_id = Auth::user()->id;

    $order = Order::where("id", "=", $id)
      ->where("seller_id", "=", $user_id)
      ->first();

    if($order){
      OrderPayment::insert([
        "order_id" => $id,
        "user_id" => $user_id,
        "payment_amount" => $order->total_payable_amount,
        "description" => "Payment accepted",
        "payment_type_id" => 1,
        "created_at" => date("Y-m-d H:i:s"),
      ]);

      return redirect()->route('order-details', ['id' => $id]);
    } else {
      return redirect()->route('orders')->withErrors(['msg' => 'Invalid request']);
    }
  }
}
