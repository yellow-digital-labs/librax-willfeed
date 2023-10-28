<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Blog;

class HomePage extends Controller
{
  public function index()
  {
    $ratings = Rating::where(['status' => 'approve'])->take(15)->orderBy("id", "DESC")->get();

    $products = Product::where(["active" => "yes"])->orderBy("name", "ASC")->get();
    
    $blogs = Blog::where(["status" => "active"])->orderBy("id", "DESC")->get();

    return view('content.pages.pages-home', [
      'ratings' => $ratings,
      'products' => $products,
      'blogs' => $blogs,
    ]);
  }
}
