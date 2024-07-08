<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\ProductSeller;
use App\Models\Blog;
use Auth;

class HomePage extends Controller
{
  public function index()
  {
    $user_id = 0;
    if(Auth::user()){
      $user_id = Auth::user()->id;
    }

    $ratings = Rating::where(['status' => 'approve'])->take(15)->orderBy("id", "DESC")->get();

    // $products = Product::where(["active" => "yes"])->orderBy("name", "ASC")->get();
    if($user_id == 0){
      $products = ProductSeller::where(["status" => "active", "customer_groups_id" => 0])->orderBy("product_name", "ASC")->get();
    } else {
      $pSeller = ProductSeller::select("product_sellers.*")->where(["product_sellers.status" => "active"])->orderBy("product_name", "ASC");
      $products = $pSeller->join('customer_verifieds as cv', function($join) use ($user_id){
        $join->where('cv.customer_id', '=', $user_id);
        $join->on('cv.customer_group', '=', 'product_sellers.customer_groups_id');
      })->get();
    }
    
    $blogs = Blog::where(["status" => "active"])->orderBy("id", "DESC")->get();

    return view('content.pages.pages-home', [
      'ratings' => $ratings,
      'products' => $products,
      'blogs' => $blogs,
    ]);
  }
}
