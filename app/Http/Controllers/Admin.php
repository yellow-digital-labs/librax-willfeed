<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Admin extends Controller
{
  public function login()
  {
    $pageConfigs = ["myLayout" => "blank"];
    $isAdmin = true;
    return view("content.pages.pages-login", [
      "pageConfigs" => $pageConfigs,
      "isAdmin" => $isAdmin
    ]);
  }
}
