<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSeller;

class BuyerHome extends Controller
{
  public function index()
  {
    $products = ProductSeller::where(["status" => "active"])->get();

    return view('content.pages.pages-buyer-home', [
      "products" => $products
    ]);
  }
}
