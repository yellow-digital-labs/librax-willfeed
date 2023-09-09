<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;

class HomePage extends Controller
{
  public function index()
  {
    $ratings = Rating::where(['status' => 'approve'])->get();

    return view('content.pages.pages-home', [
      'ratings' => $ratings,
    ]);
  }
}
