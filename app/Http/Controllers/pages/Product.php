<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSeller;
use Auth;

class Product extends Controller
{
  public function index()
  {
    $urlCreateProductView = route('product-create');
    $urlListProductData = route('product-list');

    return view('content.pages.pages-product', [
      'urlCreateProductView' => $urlCreateProductView,
      'urlListProductData' => $urlListProductData,
    ]);
  }

  public function list(Request $request)
  {
    $user_id = Auth::user()->id;
    $columns = [
      1 => "id",
      2 => "product_name",
      3 => "amount",
      4 => "status",
    ];

    $search = [];

    $f = ProductSeller::where('seller_id', '=', $user_id);
    $totalData = $f->count();

    $totalFiltered = $totalData;

    $limit = $request->input("length");
    $start = $request->input("start");
    $order = $columns[$request->input("order.0.column")];
    $dir = $request->input("order.0.dir");

    $applied_filters = [];
    foreach($request->input('columns') as $col){
      if(!empty($col['search']['value'])){
        $applied_filters[$col['data']] = $col['search']['value'];
      }
    }

    if (empty($request->input("search.value"))) {
      if(count($applied_filters)>0){
        $productsObj = ProductSeller::where("seller_id", "=", $user_id);

        foreach($applied_filters as $field => $search){
          $productsObj->where($field, "LIKE", "%{$search}%");
        }

        $products = $productsObj->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      } else {
        $products = ProductSeller::where("seller_id", "=", $user_id)
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      }
    } else {
      $search = $request->input("search.value");

      $products = ProductSeller::where("seller_id", "=", $user_id)
        ->where(function($query){
          return $query->where("product_name", "LIKE", "%{$search}%")
          ->orWhere("amount", "LIKE", "%{$search}%")
          ->orWhere("status", "LIKE", "%{$search}%");
        })
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();

      $totalFiltered = ProductSeller::where("seller_id", "=", $user_id)
        ->where(function($query){
          return $query->where("product_name", "LIKE", "%{$search}%")
          ->orWhere("amount", "LIKE", "%{$search}%")
          ->orWhere("status", "LIKE", "%{$search}%");
        })
        ->count();
    }

    $data = [];

    if (!empty($products)) {
      // providing a dummy id instead of database ids
      $ids = $start;

      foreach ($products as $product) {
        $nestedData["id"] = $user->id;
        $nestedData["fake_id"] = ++$ids;
        $nestedData["product_name"] = $user->product_name;
        $nestedData["amount"] = $user->amount;
        $nestedData["status"] = $user->status;

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

  public function create()
  {

  }
}
