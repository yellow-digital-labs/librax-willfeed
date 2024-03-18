<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PagePrivacy extends Controller
{
  public function index()
  {
    $page = Page::where(["slug" => "privacy-policy"])->first();

    if($page){
      return view('content.pages.pages-privacy', [
        "page" => $page
      ]);
    } else {
      return redirect()->route("pages-home");
    }
  }

  public function cookie()
  {
    return view('content.pages.cookie', []);
  }
}
