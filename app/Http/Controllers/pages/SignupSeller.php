<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignupSeller extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.pages.pages-signup-seller', [
      'pageConfigs' => $pageConfigs
    ]);
  }
}
