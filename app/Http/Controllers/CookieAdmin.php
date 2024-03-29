<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CookieModel;
use App\Helpers\Helpers;

class CookieAdmin extends Controller
{
  public function index()
  {
    $urlList = route("cookie-admin-list");
    return view('content.pages.cookie-admin', [
      'urlList' => $urlList
    ]);
  }

  public function list(Request $request)
  {
    $isAdmin = Helpers::isAdmin();
    $columns = [
      1 => "id",
      2 => "user_name",
      3 => "consents",
    ];

    $search = [];
    $f = CookieModel::where([]);
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
        $customersObj = CookieModel::where([]);

        foreach ($applied_filters as $field => $search) {
          $customersObj->where($field, "LIKE", "%{$search}%");
        }

        $customers = $customersObj
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      } else {
        $q = CookieModel::where([]);
        $customers = $q
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      }
    } else {
      $search = $request->input("search.value");

      $q = CookieModel::where(function ($query) use ($search) {
        return $query
          ->where("user_name", "LIKE", "%{$search}%")
          ->orWhere("consents", "LIKE", "%{$search}%")
          ->orWhere("ip_address", "LIKE", "%{$search}%");
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
        $nestedData["user_name"] = $customer->user_name;
        $nestedData["ip_address"] = $customer->ip_address;
        $nestedData["consents"] = $customer->consents;
        $nestedData["updated_at"] = date('d-m-Y H:i', strtotime($customer->created_at));

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
}
