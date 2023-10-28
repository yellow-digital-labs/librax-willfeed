<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ProductSeller;
use App\Models\Product as Products;
use App\Models\ProductSellerInventoryHistory;
use App\Models\Order;
use App\Models\Blog;
use App\Helpers\Helpers;
use Auth;
use DB;
use Redirect;

class BlogsManagement extends Controller
{
  public function index()
  {
    $user_id = Auth::user()->id;

    $urlCreateProductView = route("blogs-management-add");
    $urlListProductData = route("blogs-management-list");

    return view("content.pages.pages-blog-management", [
      "urlCreateProductView" => $urlCreateProductView,
      "urlListProductData" => $urlListProductData,
    ]);
  }

  public function list(Request $request)
  {
    $user_id = Auth::user()->id;
    $columns = [
        1 => "id",
        2 => "blog_name",
        3 => "status",
    ];

    $search = [];

    $f = Blog::where([]);
    $totalData = $f->count();

    $totalFiltered = $totalData;

    $limit = $request->input("length");
    $start = $request->input("start");
    // $order = $columns[$request->input("order.0.column")];
    // $dir = $request->input("order.0.dir");
    $order = "created_at";
    $dir = "DESC";

    $applied_filters = [];
    foreach ($request->input("columns") as $col) {
      if (!empty($col["search"]["value"])) {
        $applied_filters[$col["data"]] = $col["search"]["value"];
      }
    }

    if (empty($request->input("search.value"))) {
      if (count($applied_filters) > 0) {
        $productsObj = Blog::where([]);

        foreach ($applied_filters as $field => $search) {
          $productsObj->where($field, "LIKE", "%{$search}%");
        }

        $products = $productsObj
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      } else {
        $q = Blog::where([]);
        $products = $q
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      }
    } else {
      $search = $request->input("search.value");

        $q = Blog::where([]);

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
    }

    $data = [];

    if (!empty($products)) {
      // providing a dummy id instead of database ids
      $ids = $start;

      foreach ($products as $product) {
        $nestedData["id"] = $product->id;
        $nestedData["fake_id"] = ++$ids;
        $nestedData["blog_name"] = $product->blog_name;
        $nestedData["status"] = $product->status;

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
    $product = Blog::where(['id' => $id])->first();

    if ($product) {
      return view("content.pages.pages-blog-add", [
        "product" => $product,
        "isEdit" => true,
      ]);
    } else {
      return Redirect::back()->withErrors([
        "msg" => "Invalid blog edit request",
      ]);
    }
  }

  public function update(Request $request, $id)
  {
    $user_id = Auth::user()->id;

    $blog_avail = Blog::where([
      "id" => $id,
    ])->first();

    if (!$blog_avail) {
      return redirect::back()->withErrors([
        "msg" => "This blog is not available",
      ]);
    }

    $blog_image = $blog_avail->blog_image;
    if($request->file('blog_image')){
      $blog_image = $request->file('blog_image')->store('storage/blogs');
    }

    Blog::updateOrCreate(
      [
        "id" => $id,
      ],
      [
        "blog_name" => $request->blog_name,
        "description" => $request->description,
        "slug" => $request->slug,
        "meta_title" => $request->meta_title,
        "meta_keyword" => $request->meta_keyword,
        "meta_description" => $request->meta_description,
        "blog_image" => $blog_image,
        "status" => $request->status ? $request->status : "inactive",
      ]
    );

    return redirect()->route("blogs-management");
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

    $blog_image = $request->file('blog_image')->store('storage');
    Blog::updateOrCreate(
      [
        "id" => $request->id,
      ],
      [
        "blog_name" => $request->blog_name,
        "description" => $request->description,
        "slug" => $request->slug,
        "meta_title" => $request->meta_title,
        "meta_keyword" => $request->meta_keyword,
        "meta_description" => $request->meta_description,
        "blog_image" => $blog_image,
        "status" => $request->status ? $request->status : "inactive",
      ]
    );

    return redirect()->route("blogs-management");
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
    return view('content.pages.pages-blog-add', [
      'isEdit' => false,
    ]);
  }

  public function delete($id){
    $user = Auth::user();
    
    Blog::where([
      "id" => $id,
    ])->delete();

    return response()->json([
      "message" => "blog deleted successfully",
      "code" => 200,
      "data" => [],
    ]);
  }
}
