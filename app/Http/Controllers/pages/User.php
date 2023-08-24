<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerVerified;
use Auth;

class User extends Controller
{
  public function index()
  {
    $urlListCustomerData = route("user-list");

    return view("content.pages.pages-approved-customer", [
      "urlListCustomerData" => $urlListCustomerData,
    ]);
  }

  public function list(Request $request)
  {
    $user_id = Auth::user()->id;
    $columns = [
      1 => "id",
      2 => "customer_name",
      3 => "customer_region",
      4 => "status_on",
      5 => "customer_since",
      6 => "status",
    ];

    $search = [];

    $f = CustomerVerified::where("seller_id", "=", $user_id);
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
        $customersObj = CustomerVerified::where("seller_id", "=", $user_id)
          ->where('status', "<>", "rejected");

        foreach ($applied_filters as $field => $search) {
          $customersObj->where($field, "LIKE", "%{$search}%");
        }

        $customers = $customersObj
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      } else {
        $customers = CustomerVerified::where("seller_id", "=", $user_id)
          ->where('status', "<>", "rejected")
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      }
    } else {
      $search = $request->input("search.value");

      $customers = CustomerVerified::where("seller_id", "=", $user_id)
        ->where(function ($query) {
          return $query
          ->where('status', "<>", "rejected")
            ->where("customer_name", "LIKE", "%{$search}%")
            ->orWhere("customer_region", "LIKE", "%{$search}%")
            ->orWhere("status", "LIKE", "%{$search}%");
        })
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();

      $totalFiltered = CustomerVerified::where("seller_id", "=", $user_id)
        ->where(function ($query) {
          return $query
            ->where('status', "<>", "rejected")
            ->where("customer_name", "LIKE", "%{$search}%")
            ->orWhere("customer_region", "LIKE", "%{$search}%")
            ->orWhere("status", "LIKE", "%{$search}%");
        })
        ->count();
    }

    $data = [];

    if (!empty($customers)) {
      // providing a dummy id instead of database ids
      $ids = $start;

      foreach ($customers as $customer) {
        $nestedData["id"] = $customer->id;
        $nestedData["fake_id"] = ++$ids;
        $nestedData["customer_name"] = $customer->customer_name;
        $nestedData["customer_region"] = $customer->customer_region;
        $nestedData["status"] = $customer->status;
        $nestedData["customer_since"] = $customer->customer_since;
        $nestedData["status_on"] = $customer->status_on;

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

  public function status(Request $request, $id, $status)
  {
    $user_id = Auth::user()->id;

    CustomerVerified::where("seller_id", "=", $user_id)
      ->where("id",  "=", $id)
      ->update([
        "status" => $status
      ]);

    return response()->json([
      "message" => "Status updated successfully!",
      "code" => 200,
      "data" => [],
    ]);
  }
}
