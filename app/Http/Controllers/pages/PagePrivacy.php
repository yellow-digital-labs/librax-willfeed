<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

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
}
