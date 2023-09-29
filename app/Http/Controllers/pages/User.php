<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User as UserModel;
use App\Mail\UserRequestApprove;
use App\Mail\UserRequestReject;
use Auth;

class User extends Controller
{
  public function seller()
  {
    $urlListCustomerData = route("user-list", [
      "type" => "seller"
    ]);

    return view("content.pages.pages-user", [
      "urlListCustomerData" => $urlListCustomerData,
      "type" => "seller",
    ]);
  }

  public function buyer()
  {
    $urlListCustomerData = route("user-list", [
      "type" => "buyer"
    ]);

    return view("content.pages.pages-user", [
      "urlListCustomerData" => $urlListCustomerData,
      "type" => "buyer",
    ]);
  }

  public function list(Request $request, $type)
  {
    $user_id = Auth::user()->id;
    if($type == "seller"){
      $accountType = 2;
    } else {
      $accountType = 1;
    }
    $columns = [
      1 => "id",
      2 => "name",
      3 => "email",
      4 => "email_verified_at",
      5 => "created_at",
      6 => "approved_by_admin",
      7 => "subscription_name",
    ];

    $search = [];

    $f = UserModel::where("accountType", "=", $accountType)
      ->where("profile_completed", "=", "Yes");
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
        $customersObj = UserModel::where("accountType", "=", $accountType)
          ->where("profile_completed", "=", "Yes");

        foreach ($applied_filters as $field => $search) {
          $customersObj->where($field, "LIKE", "%{$search}%");
        }

        $customers = $customersObj
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      } else {
        $customers = UserModel::where("accountType", "=", $accountType)
          ->where("profile_completed", "=", "Yes")
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      }
    } else {
      $search = $request->input("search.value");

      $customers = UserModel::where("accountType", "=", $accountType)
        ->where("profile_completed", "=", "Yes")
        ->where(function ($query) use ($search) {
          return $query
            ->where("name", "LIKE", "%{$search}%")
            ->orWhere("email", "LIKE", "%{$search}%")
            ->orWhere("email_verified_at", "LIKE", "%{$search}%")
            ->orWhere("created_at", "LIKE", "%{$search}%")
            ->orWhere("approved_by_admin", "LIKE", "%{$search}%")
            ->orWhere("subscription_name", "LIKE", "%{$search}%");
        })
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();

      $totalFiltered = UserModel::where("accountType", "=", $accountType)
        ->where("profile_completed", "=", "Yes")
        ->where(function ($query) use ($search) {
          return $query
            ->where("name", "LIKE", "%{$search}%")
            ->orWhere("email", "LIKE", "%{$search}%")
            ->orWhere("email_verified_at", "LIKE", "%{$search}%")
            ->orWhere("created_at", "LIKE", "%{$search}%")
            ->orWhere("approved_by_admin", "LIKE", "%{$search}%")
            ->orWhere("subscription_name", "LIKE", "%{$search}%");
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
        $nestedData["name"] = $customer->name;
        $nestedData["email"] = $customer->email;
        $nestedData["email_verified_at"] = date('Y-m-d H:i:s', strtotime($customer->email_verified_at));
        $nestedData["created_at"] = date('Y-m-d H:i:s', strtotime($customer->created_at));
        $nestedData["approved_by_admin"] = $customer->approved_by_admin;
        $nestedData["subscription_name"] = $customer->subscription_name;

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
    $user_query = UserModel::where("id", "=", $id);
    
    $user_query->update([
      "approved_by_admin" => $status
    ]);

    $user = $user_query->first();

    //send email
    if($status == "Yes") { //approve
      Mail::to($user->email)->send(new UserRequestApprove([
        "url" => route("login"),
      ]));
    } else { //reject
      Mail::to($user->email)->send(new UserRequestReject([
        "url" => route("login"),
      ]));
    }

    return response()->json([
      "message" => "Status updated successfully!",
      "code" => 200,
      "data" => [],
    ]);
  }
}
