<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageTerms extends Controller
{
  public function index()
  {
    $page = Page::where(["slug" => "terms-condition"])->first();

    if($page){
      return view('content.pages.pages-terms', [
        "page" => $page
      ]);
    } else {
      return redirect()->route("pages-home");
    }
  }
}
