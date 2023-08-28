<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Helpers\Helpers;
use Auth;
use Redirect;

class CustomerRating extends Controller
{
  public function index()
  {
    $urlListRatingData = route("customer-rating-list");
    return view('content.pages.pages-customer-rating', [
      'urlListRatingData' => $urlListRatingData
    ]);
  }

  public function list(Request $request)
  {
    $isAdmin = Helpers::isAdmin();
    if(!$isAdmin){
      return Redirect::back()->withErrors([
        "msg" => "You are not authorized",
      ]);
    }

    $columns = [
      1 => "id",
      2 => "review_by_name",
      3 => "review_for_name",
      4 => "star",
      5 => "status",
      6 => "created_at",
    ];

    $search = [];

    $f = Rating::where([]);
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
        $customersObj = Rating::where([]);

        foreach ($applied_filters as $field => $search) {
          $customersObj->where($field, "LIKE", "%{$search}%");
        }

        $customers = $customersObj
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      } else {
        $customers = Rating::where([])
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      }
    } else {
      $search = $request->input("search.value");

      $customers = Rating::where([])
        ->where(function ($query) use ($search) {
          return $query
            ->where("review_by_name", "LIKE", "%{$search}%")
            ->orWhere("review_for_name", "LIKE", "%{$search}%")
            ->orWhere("star", "LIKE", "%{$search}%")
            ->orWhere("status", "LIKE", "%{$search}%");
        })
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();

      $totalFiltered = Rating::where([])
        ->where(function ($query) use ($search) {
          return $query
            ->where("review_by_name", "LIKE", "%{$search}%")
            ->orWhere("review_for_name", "LIKE", "%{$search}%")
            ->orWhere("star", "LIKE", "%{$search}%")
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
        $nestedData["review_by_name"] = $customer->review_by_name;
        $nestedData["review_for_name"] = $customer->review_for_name;
        $nestedData["star"] = $customer->star;
        $nestedData["review_text"] = $customer->review_text;
        $nestedData["status"] = $customer->status;
        $nestedData["created_at"] = $customer->created_at;

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
    $isAdmin = Helpers::isAdmin();
    if(!$isAdmin){
      return response()->json([
        "message" => "You are not authorized",
        "code" => 500,
        "data" => [],
      ]);
    }

    Rating::where("id", "=", $id)
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
