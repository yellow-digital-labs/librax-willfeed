<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSeller;
use App\Models\Product as Products;
use Auth;
use Redirect;

class Product extends Controller
{
  public function index()
  {
    $urlCreateProductView = route("product-create");
    $urlListProductData = route("product-list");

    return view("content.pages.pages-product", [
      "urlCreateProductView" => $urlCreateProductView,
      "urlListProductData" => $urlListProductData,
    ]);
  }

  public function list(Request $request)
  {
    $user_id = Auth::user()->id;
    $columns = [
      1 => "id",
      2 => "product_name",
      3 => "amount_before_tax",
      4 => "status",
    ];

    $search = [];

    $f = ProductSeller::where("seller_id", "=", $user_id);
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
        $productsObj = ProductSeller::where("seller_id", "=", $user_id);

        foreach ($applied_filters as $field => $search) {
          $productsObj->where($field, "LIKE", "%{$search}%");
        }

        $products = $productsObj
          ->offset($start)
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
        ->where(function ($query) {
          return $query
            ->where("product_name", "LIKE", "%{$search}%")
            ->orWhere("amount_before_tax", "LIKE", "%{$search}%")
            ->orWhere("status", "LIKE", "%{$search}%");
        })
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();

      $totalFiltered = ProductSeller::where("seller_id", "=", $user_id)
        ->where(function ($query) {
          return $query
            ->where("product_name", "LIKE", "%{$search}%")
            ->orWhere("amount_before_tax", "LIKE", "%{$search}%")
            ->orWhere("status", "LIKE", "%{$search}%");
        })
        ->count();
    }

    $data = [];

    if (!empty($products)) {
      // providing a dummy id instead of database ids
      $ids = $start;

      foreach ($products as $product) {
        $nestedData["id"] = $product->id;
        $nestedData["fake_id"] = ++$ids;
        $nestedData["product_name"] = $product->product_name;
        $nestedData["amount_before_tax"] = "€".$product->amount_before_tax."/LITERS";
        $nestedData["status"] = $product->status;
        $nestedData["product_id"] = $product->product_id;

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

  public function edit($id)
  {
    $user_id = Auth::user()->id;
    $products = Products::where(["active" => "yes"])->get();
    $product_detail = ProductSeller::where(["product_id" => $id, "seller_id" => $user_id])->first();

    if($product_detail){
      return view("content.pages.pages-product-create", [
        "products" => $products,
        "product_detail" => $product_detail
      ]);
    } else {
      return Redirect::back()->withErrors(["msg" => "Invalid product edit request"]);
    }
  }

  public function update(Request $request, $id)
  {
    $user_id = Auth::user()->id;

    $product_avail = ProductSeller::where(["product_id" => $id])->count();

    if($product_avail==0){
      return redirect::back()->withErrors(["msg" => "This product is not available"]);
    }

    ProductSeller::updateOrCreate(
      [
        'seller_id' => $user_id,
        'product_id' => $request->product_id
      ],
      [
        'amount_before_tax' => $request->amount_before_tax,
        'amount_30gg' => $request->amount_30gg,
        'amount_60gg' => $request->amount_60gg,
        'amount_90gg' => $request->amount_90gg,
        'status' => $request->status?$request->status:'inactive'
      ]
    );

    return redirect()->route("product");
  }

  public function create()
  {
    $products = Products::where(["active" => "yes"])->get();
    return view("content.pages.pages-product-create", [
      "products" => $products,
      "product_detail" => [],
    ]);
  }

  public function store(Request $request)
  {
    $user_id = Auth::user()->id;

    $product_avail = ProductSeller::where(["product_id" => $request->product_id])->count();

    if($product_avail>0){
      return redirect::back()->withErrors(["msg" => "This product is already added"]);
    }

    ProductSeller::updateOrCreate(
      [
        'seller_id' => $user_id,
        'product_id' => $request->product_id
      ],
      [
        'amount_before_tax' => $request->amount_before_tax,
        'amount_30gg' => $request->amount_30gg,
        'amount_60gg' => $request->amount_60gg,
        'amount_90gg' => $request->amount_90gg,
        'status' => $request->status?$request->status:'inactive'
      ]
    );

    return redirect()->route("product");
  }
}