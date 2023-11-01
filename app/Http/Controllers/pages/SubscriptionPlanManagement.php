<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Helpers\Helpers;
use Auth;

class SubscriptionPlanManagement extends Controller
{
  public function index()
  {
    $isAdmin = Helpers::isAdmin();
    if(!$isAdmin){
      return Redirect::back()->withErrors([
        "msg" => "You are not authorized",
      ]);
    }

    $urlListSubscribeData = route("subscription-plan-management-list");

    return view('content.pages.pages-subscription-plan-management', [
      "urlListSubscribeData" => $urlListSubscribeData,
    ]);
  }

  public function list(Request $request)
  {
    $isAdmin = Helpers::isAdmin();
    $user_id = Auth::user()->id;
    if(!$isAdmin){
      return Redirect::back()->withErrors([
        "msg" => "You are not authorized",
      ]);
    }

    $columns = [
      1 => "id",
      2 => "name",
      3 => "amount",
      4 => "status",
    ];

    $search = [];

    $f = Subscription::where([]);
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
        $customersObj = Subscription::where([]);
        
        foreach ($applied_filters as $field => $search) {
          $customersObj->where($field, "LIKE", "%{$search}%");
        }

        $customers = $customersObj
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      } else {
        $customers = Subscription::where([])
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      }
    } else {
      $search = $request->input("search.value");

      $q = Subscription::where(function ($query) use ($search) {
        return $query
          ->where("name", "LIKE", "%{$search}%")
          ->orWhere("amount", "LIKE", "%{$search}%")
          ->orWhere("status", "LIKE", "%{$search}%");
      });
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
        $nestedData["name"] = $customer->name;
        $nestedData["amount"] = "€".$customer->amount;
        $nestedData["status"] = $customer->status;

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
    $user_id = Auth::user()->id;

    if($isAdmin){
      $order = Order::where("id", "=", $id)
        ->first();
    } else {
      $order = Order::where("id", "=", $id)
        ->where("seller_id", "=", $user_id)
        ->first();
    }

    if($order){
      $customer_total_orders = Order::where("user_id", "=", $order->user_id)
        ->where("seller_id", "=", $order->seller_id)
        ->count();

      $order_activity = OrderActivityHistory::where("order_id", "=", $id)->get();

      return view("content.pages.pages-order-details", [
        'id' => $id,
        'order' => $order,
        'customer_total_orders' => $customer_total_orders,
        'order_activity' => $order_activity,
        'isAdmin' => $isAdmin,
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

  public function add(Request $request)
  {
    $subscription = Subscription::create([
      "name" => $request->name,
      "tagline" => $request->tagline,
      "amount" => $request->amount,
      "description" => $request->description,
      "status" => $request->status?'active':'inactive',
      "plan_for" => $request->plan_for,
    ]);

    return redirect()->back();
    // return response()->json($subscription);
  }

  public function edit($id)
  {
    $subscription = Subscription::where(['id' => $id])->first();

    return response()->json($subscription);
  }

  public function store(Request $request, $id)
  {
    $subscription = Subscription::where(['id' => $id])->update([
      "name" => $request->name,
      "tagline" => $request->tagline,
      "amount" => $request->amount,
      "description" => $request->description,
      "status" => $request->status?'active':'inactive',
      "plan_for" => $request->plan_for,
    ]);

    return redirect()->back();
    // return response()->json($subscription);
  }
}
