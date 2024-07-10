<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ProductSeller;
use App\Models\Product as Products;
use App\Models\ProductSellerInventoryHistory;
use App\Models\Order;
use App\Models\CustomerGroup;
use App\Helpers\Helpers;
use Auth;
use DB;
use Redirect;

class Product extends Controller
{
  public function index(Request $request)
  {
    $isAdmin = Helpers::isAdmin();
    $user_id = Auth::user()->id;
    $customerGroup = $request->customerGroup ?? 0;

    if($isAdmin){
      $urlCreateProductView = route("product-add");
    } else {
      $urlCreateProductView = route("product-create");
    }
    $urlListProductData = route("product-list")."?customerGroup=".$customerGroup;

    $customerGroupsList = [];
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

      $customerGroupsList = CustomerGroup::where(["vendor_id" => $user_id, "status" => "active"])->get();
    }

    return view("content.pages.pages-product", [
      "urlCreateProductView" => $urlCreateProductView,
      "urlListProductData" => $urlListProductData,
      "total_products" => $total_products,
      "active_products" => $active_products,
      "inactive_products" => $inactive_products,
      "bestSeller" => $bestSeller,
      "isAdmin" => $isAdmin,
      "customerGroupsList" => $customerGroupsList,
      "customerGroup" => $customerGroup,
    ]);
  }

  public function list(Request $request)
  {
    $isAdmin = Helpers::isAdmin();
    $user_id = Auth::user()->id;
    $customerGroup = $request->customerGroup ?? 0;
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
        4 => "updated_at",
        5 => "price_validate",
        6 => "status",
      ];
    }

    $search = [];

    if($isAdmin){
      $f = Products::where([]);
    } else {
      $f = ProductSeller::where("seller_id", "=", $user_id)
        ->where("customer_groups_id", "=", $customerGroup);
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
          $productsObj = ProductSeller::where("seller_id", "=", $user_id)
            ->where("customer_groups_id", "=", $customerGroup);
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
          $q = ProductSeller::where("seller_id", "=", $user_id)
            ->where("customer_groups_id", "=", $customerGroup);
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
        $q = ProductSeller::where("seller_id", "=", $user_id)
          ->where("customer_groups_id", "=", $customerGroup);

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
          $nestedData["amount_before_tax"] = "€" . formatAmountForItaly($product->amount_before_tax) . "/LITERS";
          $nestedData["updated_at"] = date("d-m-Y H:i", strtotime($product->updated_at));
          if($product->price_type == "PLATTS"){
            $nestedData["price_validate"] = true;
          } else {
            $nestedData["price_validate"] = (date('Y-m-d', strtotime($product->updated_at)) == date('Y-m-d') ? true : false);
          }
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

  public function edit(Request $request, $id)
  {
    $user_id = Auth::user()->id;
    $customerGroup = $request->customerGroup ?? 0;
    $customerGroupName = "Primo prezzo";
    $products = Products::where(["active" => "yes"])->get();
    $product_detail = ProductSeller::where([
      "product_id" => $id,
      "seller_id" => $user_id,
      "customer_groups_id" => $customerGroup,
    ])->first();
    $days = Helpers::listOfDays();

    $_product = Products::where(['id' => $id])->first();

    if($customerGroup != 0){
      $cg = CustomerGroup::where(["id" => $customerGroup])->first();
      $customerGroupName = $cg->customer_group_name;
    }

    if ($product_detail) {
      return view("content.pages.pages-product-create", [
        "products" => $products,
        "product_detail" => $product_detail,
        "_product" => $_product,
        "days" => $days,
        "customerGroup" => $customerGroup,
        "customerGroupName" => $customerGroupName,
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
    $customerGroup = $request->customerGroup ?? 0;

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
        "customer_groups_id" => $customerGroup,
      ],
      [
        "price_value" => $request->price_value,
        "price_value_30gg" => $request->price_value_30gg,
        "price_value_60gg" => $request->price_value_60gg,
        "price_value_90gg" => $request->price_value_90gg,
      ]
    );

    if($customerGroup == "0"){
      ProductSeller::where([
        "seller_id" => $user_id,
        "product_id" => $request->product_id,
      ])->update([
        "delivery_time" => $request->delivery_time,
        "delivery_days" => 'Il giorno dopo',
        "days_off" => $request->days_off?implode(",",$request->days_off):"",
        "status" => $request->status ? $request->status : "inactive",
        "need_to_update" => 1
      ]);
    }

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
            "tax" => $request->tax,
            "description" => $request->description,
            "active" => $request->active ? "yes" : "no",
            "today_price" => $request->today_price?$request->today_price:0,
            "price_type" => $request->price_type,
        ]);
      } else {
        try{
          Products::create([
              "name" => $request->name,
              "tax" => $request->tax,
              "description" => $request->description,
              "price_type" => $request->price_type,
              "active" => $request->active ? "yes" : "no",
              "today_price" => $request->today_price?$request->today_price:0,
          ]);
        } catch(\Illuminate\Database\QueryException $e){
          if(Str::contains($e->getMessage(), 'Duplicate entry')){
            return Redirect::back()->withErrors([
              "msg" => "Product is already available with the same name",
            ]);
          } else {
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
    $customerGroup = 0;
    $customerGroupName = "Primo prezzo";
    $products = Products::where(["active" => "yes"])->get();
    $days = Helpers::listOfDays();
    return view("content.pages.pages-product-create", [
      "products" => $products,
      "product_detail" => [],
      "_product" => [],
      "days" => $days,
      "customerGroupName" => $customerGroupName,
      "customerGroup" => $customerGroup,
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

    $qty = 0;
    if($request->qty){
      $qty = $request->qty;
    }

    ProductSeller::updateOrCreate(
      [
        "seller_id" => $user_id,
        "product_id" => $request->product_id,
        "customer_groups_id" => 0,
      ],
      [
        "price_value" => $request->price_value,
        "price_value_30gg" => $request->price_value_30gg,
        "price_value_60gg" => $request->price_value_60gg,
        "price_value_90gg" => $request->price_value_90gg,
        "delivery_time" => $request->delivery_time,
        "delivery_days" => 'Il giorno dopo',
        "days_off" => $request->days_off?implode(",",$request->days_off):"",
        "status" => $request->status ? $request->status : "inactive",
        "current_stock" => $qty,
      ]
    );

    $customer_groups = CustomerGroup::where(["vendor_id" => $user_id])->get();
    foreach($customer_groups as $customer_group){
      ProductSeller::updateOrCreate(
        [
          "seller_id" => $user_id,
          "product_id" => $request->product_id,
          "customer_groups_id" => $customer_group->id,
        ],
        [
          "price_value" => $request->price_value,
          "price_value_30gg" => $request->price_value_30gg,
          "price_value_60gg" => $request->price_value_60gg,
          "price_value_90gg" => $request->price_value_90gg,
          "delivery_time" => $request->delivery_time,
          "delivery_days" => 'Il giorno dopo',
          "days_off" => $request->days_off?implode(",",$request->days_off):"",
          "status" => $request->status ? $request->status : "inactive",
          "current_stock" => $qty,
        ]
      );
    }

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
      "tax" => $product->tax,
      "price_type" => $product->price_type,
      "today_price" => $product->today_price,
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
    $avail = ProductSeller::where([
      "product_id" => $id,
    ])->count();
    if($avail>0){
      return response()->json([
        "message" => "Product is in use at seller side. Could not be able to delete.",
        "code" => 201,
        "data" => [],
      ]);
    } else {
      Products::where([
        "id" => $id
      ])->delete();
    }

    return response()->json([
      "message" => "Product deleted successfully",
      "code" => 200,
      "data" => [],
    ]);
  }
}
