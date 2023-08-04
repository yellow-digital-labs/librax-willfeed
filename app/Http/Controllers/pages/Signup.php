<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\AccountType;

class Signup extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];

    $accountType = AccountType::all();
    return view('content.pages.pages-signup', [
      'pageConfigs' => $pageConfigs,
      'accountType' => $accountType
    ]);
  }
}
