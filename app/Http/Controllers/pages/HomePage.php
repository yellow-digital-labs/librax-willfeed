<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Product;

class HomePage extends Controller
{
  public function index()
  {
    $ratings = Rating::where(['status' => 'approve'])->get();

    $products = Product::where(["active" => "yes"])->get();

    return view('content.pages.pages-home', [
      'ratings' => $ratings,
      'products' => $products,
    ]);
  }
}
