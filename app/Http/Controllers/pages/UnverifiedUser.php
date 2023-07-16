<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnverifiedUser extends Controller
{
  public function index()
  {
    return view('content.pages.pages-unverified-users');
  }
  public function details()
  {
    return view('content.pages.pages-unverified-users-details');
  }
}
