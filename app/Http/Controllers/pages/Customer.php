<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\CustomerVerified;
use App\Models\User;
use App\Models\CustomerGroup;
use App\Models\SystemNotification;
use App\Mail\CustomerRequestApprove;
use App\Mail\CustomerRequestReject;
use App\Mail\SellerRequestApprove;
use App\Mail\SellerRequestReject;
use App\Helpers\Helpers;
use Auth;

class Customer extends Controller
{
  public function index()
  {
    $urlListCustomerData = route("customer-list");

    $customer_groups = [];
    if(Helpers::isSeller()){
      $user_id = Auth::user()->id;
      $customer_groups = CustomerGroup::where("vendor_id", "=", $user_id)->get();
    }

    return view("content.pages.pages-approved-customer", [
      "urlListCustomerData" => $urlListCustomerData,
      "isSeller" => Helpers::isSeller(),
      "customer_groups" => $customer_groups,
    ]);
  }

  public function list(Request $request)
  {
    $user_id = Auth::user()->id;
    $columns = [
      0 => "customer_name",
      1 => "seller_name",
      2 => "customer_region",
      3 => "status_on",
      4 => "customer_since",
      5 => "customer_group",
      6 => "credit_limit",
      7 => "credit_used",
      8 => "credit_avail",
      9 => "status",
      10 => "customer_id",
      11 => "seller_id",
    ];

    $search = [];

    if(Helpers::isSeller()){
      $f = CustomerVerified::where("seller_id", "=", $user_id);
    } else {
      $f = CustomerVerified::where("customer_id", "=", $user_id);
    }
    $totalData = $f->count();

    $totalFiltered = $totalData;

    $limit = $request->input("length");
    $start = $request->input("start");
    // $order = $columns[$request->input("order.0.column")];
    // $dir = $request->input("order.0.dir");
    $order = "id";
    $dir = "desc";

    $applied_filters = [];
    foreach ($request->input("columns") as $col) {
      if (!empty($col["search"]["value"])) {
        $applied_filters[$col["data"]] = $col["search"]["value"];
      }
    }

    if (empty($request->input("search.value"))) {
      if (count($applied_filters) > 0) {
        if(Helpers::isSeller()){
          $customersObj = CustomerVerified::where("seller_id", "=", $user_id)
            ->where('status', "<>", "rejected");
        } else {
          $customersObj = CustomerVerified::where("customer_id", "=", $user_id)
            ->where('status', "<>", "rejected");
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
        if(Helpers::isSeller()){
          $customers = CustomerVerified::where("seller_id", "=", $user_id)
            ->where('status', "<>", "rejected")
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        } else {
          $customers = CustomerVerified::where("customer_id", "=", $user_id)
            ->where('status', "<>", "rejected")
            ->offset($start)
            ->limit($limit)
            ->orderBy($order, $dir)
            ->get();
        }
      }
    } else {
      $search = $request->input("search.value");

      if(Helpers::isSeller()){
        $customers = CustomerVerified::where("seller_id", "=", $user_id)
          ->where(function ($query) use ($search) {
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
          ->where(function ($query) use ($search) {
            return $query
              ->where('status', "<>", "rejected")
              ->where("customer_name", "LIKE", "%{$search}%")
              ->orWhere("customer_region", "LIKE", "%{$search}%")
              ->orWhere("status", "LIKE", "%{$search}%");
          })
          ->count();
      } else {
        $customers = CustomerVerified::where("customer_id", "=", $user_id)
          ->where(function ($query) use ($search) {
            return $query
            ->where('status', "<>", "rejected")
              ->where("seller_name", "LIKE", "%{$search}%")
              ->orWhere("status", "LIKE", "%{$search}%");
          })
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();

        $totalFiltered = CustomerVerified::where("customer_id", "=", $user_id)
          ->where(function ($query) use ($search) {
            return $query
              ->where('status', "<>", "rejected")
              ->where("seller_name", "LIKE", "%{$search}%")
              ->orWhere("status", "LIKE", "%{$search}%");
          })
          ->count();
      }
    }

    $data = [];

    if (!empty($customers)) {
      // providing a dummy id instead of database ids
      $ids = $start;

      foreach ($customers as $customer) {
        $nestedData["id"] = $customer->id;
        $nestedData["fake_id"] = ++$ids;
        $nestedData["customer_name"] = $customer->customer_name;
        $nestedData["seller_name"] = $customer->seller_name;
        $nestedData["customer_region"] = $customer->customer_region;
        $nestedData["status"] = $customer->status;
        $nestedData["is_request_by_seller"] = $customer->is_request_by_seller;
        $nestedData["customer_since"] = $customer->customer_since;
        $nestedData["status_on"] = $customer->status_on;
        $nestedData["customer_group"] = $customer->customer_group;
        $nestedData["customer_id"] = $customer->customer_id;
        $nestedData["seller_id"] = $customer->seller_id;
        $nestedData["credit_limit"] = "€".formatAmountForItaly($customer->credit_limit);
        $nestedData["credit_used"] = "€".formatAmountForItaly($customer->credit_used);
        $nestedData["credit_avail"] = "€".formatAmountForItaly($customer->credit_avail);

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

  public function group(Request $request, $id, $status){
    $user = Auth::user();
    $user_id = $user->id;

    if($user->accountType == "2"){ //seller login
      $query = CustomerVerified::where("seller_id", "=", $user_id)
        ->where("id",  "=", $id)
        ->update([
          "customer_group" => $status
        ]);

      return response()->json([
        "message" => "customer group updated successfully!",
        "code" => 200,
        "data" => [],
      ]);
    }
  }

  public function status(Request $request, $id, $status)
  {
    $user = Auth::user();
    $user_id = $user->id;

    if($user->accountType == "2"){ //seller login
      $query = CustomerVerified::where("seller_id", "=", $user_id)
        ->where("id",  "=", $id);

      if($status == "approved"){
        if($request->only_update == "yes"){
          $query
            ->update([
              "credit_limit" => $request->credit_limit,
            ]);
        } else {
          $query
            ->update([
              "status" => $status,
              "credit_limit" => $request->credit_limit,
            ]);
        }
      } else {
        $query
          ->update([
            "status" => $status
          ]);
      }
  
      if($request->only_update == "yes"){
  
      } else {
        if($status != "pending"){
          $CustomerVerified = $query->first();
          $buyer = User::where("id", $CustomerVerified->customer_id)->first();
          $seller = User::where("id", $CustomerVerified->seller_id)->first();
        }
    
        if($status == "approved"){ //Approved
          SystemNotification::create([
            "user_id" => $CustomerVerified->customer_id,
            "module" => "App/Model/CustomerRequest",
            "record_id" => $user_id,
            "notification_title" => "Profilo approvato dal venditore",
            "notification_desc" => "La collaborazione di richiesta inviata a {$user->name} è stata accettata",
            "is_read" => false
          ]);
          Mail::to($buyer->email)->send(new CustomerRequestApprove([
            "sellerName" => $seller->name,
            "url" => route("pages-buyer-home")
          ]));
        } else if($status == "rejected"){ //Rejected
          SystemNotification::create([
            "user_id" => $CustomerVerified->customer_id,
            "module" => "App/Model/CustomerRequest",
            "record_id" => $user_id,
            "notification_title" => "Profilo rifiutato dal venditore",
            "notification_desc" => "La collaborazione di richiesta inviata a {$user->name} è stata rifiutata",
            "is_read" => false
          ]);
          Mail::to($buyer->email)->send(new CustomerRequestReject([
            "sellerName" => $seller->name,
            "url" => route("pages-buyer-home")
          ]));
        }
      }
    } else { //buyer login
      $query = CustomerVerified::where("customer_id", "=", $user_id)
        ->where("id",  "=", $id);
      $query
        ->update([
          "status" => $status
        ]);
  
      if($request->only_update == "yes"){
  
      } else {
        if($status != "pending"){
          $CustomerVerified = $query->first();
          $buyer = User::where("id", $CustomerVerified->customer_id)->first();
          $seller = User::where("id", $CustomerVerified->seller_id)->first();
        }
    
        if($status == "approved"){ //Approved
          SystemNotification::create([
            "user_id" => $CustomerVerified->seller_id,
            "module" => "App/Model/SellerRequest",
            "record_id" => $CustomerVerified->customer_id,
            "notification_title" => "Profilo accettata dall'acquirente",
            "notification_desc" => " La collaborazione di richiesta inviata a {$user->name} è stata accettata",
            "is_read" => false
          ]);
          Mail::to($seller->email)->send(new SellerRequestApprove([
            "buyerName" => $buyer->name,
          ]));
        } else if($status == "rejected"){ //Rejected
          SystemNotification::create([
            "user_id" => $CustomerVerified->seller_id,
            "module" => "App/Model/SellerRequest",
            "record_id" => $CustomerVerified->customer_id,
            "notification_title" => "Profilo rifiutata dall'acquirente",
            "notification_desc" => "La collaborazione di richiesta inviata a {$user->name} è stata rifiutata",
            "is_read" => false
          ]);
          Mail::to($seller->email)->send(new SellerRequestReject([
            "buyerName" => $buyer->name,
          ]));
        }
      }
    }

    return response()->json([
      "message" => "Status updated successfully!",
      "code" => 200,
      "data" => [],
    ]);
  }
}
