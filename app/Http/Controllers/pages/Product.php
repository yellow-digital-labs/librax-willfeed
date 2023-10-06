<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ProductSeller;
use App\Models\Product as Products;
use App\Models\ProductSellerInventoryHistory;
use App\Models\Order;
use App\Helpers\Helpers;
use Auth;
use DB;
use Redirect;

class Product extends Controller
{
  public function index()
  {
    $isAdmin = Helpers::isAdmin();
    $user_id = Auth::user()->id;

    if($isAdmin){
      $urlCreateProductView = route("product-add");
    } else {
      $urlCreateProductView = route("product-create");
    }
    $urlListProductData = route("product-list");

    if($isAdmin){
      $total_products = Products::where([])->count();
      $active_products = Products::where(["active" => "yes"])->count();
      $inactive_products = Products::where(["active" => "no"])->count();
      $bestSeller = Order::where([])
        ->select('product_name', DB::raw('COUNT(id) as total_orders'), DB::raw('SUM(total_payable_amount) as total_sales'))
        ->groupBy('product_name')
        ->orderBy('total_orders', 'DESC')
        ->orderBy('total_sales', 'DESC')
        ->first();
    } else {
      $total_products = ProductSeller::where(['seller_id' => $user_id])->count();
      $active_products = ProductSeller::where(['seller_id' => $user_id, "status" => "active"])->count();
      $inactive_products = ProductSeller::where(['seller_id' => $user_id, "status" => "inactive"])->count();
      $bestSeller = Order::where(['seller_id' => $user_id])
        ->select('product_name', DB::raw('COUNT(id) as total_orders'), DB::raw('SUM(total_payable_amount) as total_sales'))
        ->groupBy('product_name')
        ->orderBy('total_orders', 'DESC')
        ->orderBy('total_sales', 'DESC')
        ->first();
    }

    return view("content.pages.pages-product", [
      "urlCreateProductView" => $urlCreateProductView,
      "urlListProductData" => $urlListProductData,
      "total_products" => $total_products,
      "active_products" => $active_products,
      "inactive_products" => $inactive_products,
      "bestSeller" => $bestSeller,
      "isAdmin" => $isAdmin,
    ]);
  }

  public function list(Request $request)
  {
    $isAdmin = Helpers::isAdmin();
    $user_id = Auth::user()->id;
    if($isAdmin){
      $columns = [
        1 => "id",
        2 => "name",
        3 => "active",
      ];
    } else {
      $columns = [
        1 => "id",
        2 => "product_name",
        3 => "amount_before_tax",
        4 => "status",
      ];
    }

    $search = [];

    if($isAdmin){
      $f = Products::where([]);
    } else {
      $f = ProductSeller::where("seller_id", "=", $user_id);
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
          $productsObj = Products::where([]);
        } else {
          $productsObj = ProductSeller::where("seller_id", "=", $user_id);
        }

        foreach ($applied_filters as $field => $search) {
          $productsObj->where($field, "LIKE", "%{$search}%");
        }

        $products = $productsObj
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      } else {
        if($isAdmin){
          $q = Products::where([]);
        } else {
          $q = ProductSeller::where("seller_id", "=", $user_id);
        }
        $products = $q
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      }
    } else {
      $search = $request->input("search.value");

      if($isAdmin){
        $q = Products::where([]);

        $products = $q
          ->where(function ($query) use ($search) {
            return $query
              ->where("name", "LIKE", "%{$search}%")
              ->orWhere("active", "LIKE", "%{$search}%");
          })
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();

        $totalFiltered = $q
          ->where(function ($query) use ($search) {
            return $query
              ->where("name", "LIKE", "%{$search}%")
              ->orWhere("active", "LIKE", "%{$search}%");
          })
          ->count();
      } else {
        $q = ProductSeller::where("seller_id", "=", $user_id);

        $products = $q
          ->where(function ($query) use ($search) {
            return $query
              ->where("product_name", "LIKE", "%{$search}%")
              ->orWhere("amount_before_tax", "LIKE", "%{$search}%")
              ->orWhere("status", "LIKE", "%{$search}%");
          })
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();

        $totalFiltered = $q
          ->where(function ($query) use ($search) {
            return $query
              ->where("product_name", "LIKE", "%{$search}%")
              ->orWhere("amount_before_tax", "LIKE", "%{$search}%")
              ->orWhere("status", "LIKE", "%{$search}%");
          })
          ->count();
      }
    }

    $data = [];

    if (!empty($products)) {
      // providing a dummy id instead of database ids
      $ids = $start;

      foreach ($products as $product) {
        $nestedData["id"] = $product->id;
        $nestedData["fake_id"] = ++$ids;
        if($isAdmin){
          $nestedData["name"] = $product->name;
          $nestedData["active"] = $product->active;
        } else {
          $nestedData["product_name"] = $product->product_name;
          $nestedData["amount_before_tax"] =
            "€" . $product->amount_before_tax . "/LITERS";
          $nestedData["status"] = $product->status;
          $nestedData["product_id"] = $product->product_id;
        }

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
    $product_detail = ProductSeller::where([
      "product_id" => $id,
      "seller_id" => $user_id,
    ])->first();
    $days = Helpers::listOfDays();

    $_product = Products::where(['id' => $id])->first();

    if ($product_detail) {
      return view("content.pages.pages-product-create", [
        "products" => $products,
        "product_detail" => $product_detail,
        "_product" => $_product,
        "days" => $days
      ]);
    } else {
      return Redirect::back()->withErrors([
        "msg" => "Invalid product edit request",
      ]);
    }
  }

  public function update(Request $request, $id)
  {
    $user_id = Auth::user()->id;

    $product_avail = ProductSeller::where([
      "product_id" => $id,
      "seller_id" => $user_id
    ])->count();

    if ($product_avail == 0) {
      return redirect::back()->withErrors([
        "msg" => "This product is not available",
      ]);
    }

    ProductSeller::updateOrCreate(
      [
        "seller_id" => $user_id,
        "product_id" => $request->product_id,
      ],
      [
        "amount_before_tax" => $request->amount_before_tax,
        "amount_30gg" => $request->amount_30gg,
        "amount_60gg" => $request->amount_60gg,
        "amount_90gg" => $request->amount_90gg,
        "delivery_time" => $request->delivery_time,
        "delivery_days" => $request->delivery_days,
        "days_off" => $request->days_off?implode(",",$request->days_off):"",
        "status" => $request->status ? $request->status : "inactive",
      ]
    );

    return redirect()->route("product");
  }

  public function editAdmin($id)
  {
    $isAdmin = Helpers::isAdmin();
    if($isAdmin){
      $product = Products::where(['id' => $id])->first();

      return view('content.pages.pages-product-add', [
        'isEdit' => true,
        'id' => $id,
        'product' => $product
      ]);
    } else {
      return Redirect::back()->withErrors([
        "msg" => "Not authorized",
      ]);
    }
  }

  public function updateAdmin(Request $request, $id = 0)
  {
    $isAdmin = Helpers::isAdmin();
    if($isAdmin){
      if($id != 0){
        $product_avail = Products::where([
          "id" => $id,
        ])->count();
    
        if ($product_avail == 0) {
          return redirect::back()->withErrors([
            "msg" => "This product is not available",
          ]);
        }

        Products::where([
          "id" => $id,
        ])->update([
            "name" => $request->name,
            "description" => $request->description,
            "active" => $request->active ? "yes" : "no",
            "today_price" => $request->today_price?$request->today_price:0,
        ]);
      } else {
        try{
          Products::create([
              "name" => $request->name,
              "description" => $request->description,
              "active" => $request->active ? "yes" : "no",
              "today_price" => $request->today_price?$request->today_price:0,
          ]);
        } catch(\Illuminate\Database\QueryException $e){
          if(Str::contains($e->getMessage(), 'Duplicate entry')){
            return Redirect::back()->withErrors([
              "msg" => "Product is already available with the same name",
            ]);
          } else {
            dd($e->getMessage());
            return Redirect::back()->withErrors([
              "msg" => "Something went wrong!",
            ]);
          }
        }
      }
  
      return redirect()->route("product");
    } else {
      return Redirect::back()->withErrors([
        "msg" => "Not authorized",
      ]);
    }
  }

  public function create()
  {
    $products = Products::where(["active" => "yes"])->get();
    $days = Helpers::listOfDays();
    return view("content.pages.pages-product-create", [
      "products" => $products,
      "product_detail" => [],
      "_product" => [],
      "days" => $days
    ]);
  }

  public function store(Request $request)
  {
    $user_id = Auth::user()->id;

    $product_avail = ProductSeller::where([
      "product_id" => $request->product_id,
      "seller_id" => $user_id
    ])->count();

    if ($product_avail > 0) {
      return back()->withErrors([
        "msg" => "This product is already added",
      ]);
    }

    ProductSeller::updateOrCreate(
      [
        "seller_id" => $user_id,
        "product_id" => $request->product_id,
      ],
      [
        "amount_before_tax" => $request->amount_before_tax,
        "amount_30gg" => $request->amount_30gg,
        "amount_60gg" => $request->amount_60gg,
        "amount_90gg" => $request->amount_90gg,
        "delivery_time" => $request->delivery_time,
        "delivery_days" => $request->delivery_days,
        "days_off" => $request->days_off,
        "status" => $request->status ? $request->status : "inactive",
      ]
    );

    return redirect()->route("product");
  }

  public function stock(Request $request, $id)
  {
    $user_id = Auth::user()->id;

    $product_avail = ProductSeller::where([
      "product_id" => $id,
      "seller_id" => $user_id
    ])->count();

    if ($product_avail == 0) {
      return response()->json([
        "message" => "Product is not available",
        "code" => 400,
        "data" => [],
      ]);
    }

    ProductSellerInventoryHistory::create([
      "seller_id" => $user_id,
      "product_id" => $id,
      "qty" => $request->qty
    ]);

    $seller_product = ProductSeller::where(['seller_id' => $user_id, "product_id" => $id])->first();

    $data = [
      'current_stock' => number_format($seller_product->current_stock, 0, ',', '.'),
      'stock_in_transit' => number_format($seller_product->stock_in_transit, 0, ',', '.'),
      'stock_lifetime' => number_format($seller_product->stock_lifetime, 0, ',', '.'),
      'stock_updated_at' => date('dS F, Y', strtotime($seller_product->stock_updated_at))
    ];

    return response()->json([
      "message" => "Product inventory added successfully",
      "code" => 200,
      "data" => $data,
    ]);
  }

  public function detail(Request $request, $id){

    $product = Products::where(["id" => $id])->first();

    return response()->json([
      "message" => "Product details fetched successfully",
      "code" => 200,
      "data" => $product->description,
    ]);
  }

  public function add()
  {
    return view('content.pages.pages-product-add', [
      'isEdit' => false,
    ]);
  }

  public function delete($id){
    $user = Auth::user();
    
    ProductSeller::where([
      "product_id" => $id,
      "seller_id" => $user->id
    ])->delete();

    return response()->json([
      "message" => "Product deleted successfully",
      "code" => 200,
      "data" => [],
    ]);
  }

  public function deleteAdmin($id){
    Products::where([
      "id" => $id
    ])->delete();

    return response()->json([
      "message" => "Product deleted successfully",
      "code" => 200,
      "data" => [],
    ]);
  }
}
