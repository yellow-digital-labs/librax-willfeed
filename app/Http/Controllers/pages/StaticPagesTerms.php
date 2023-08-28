<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Helpers\Helpers;
use Auth;

class StaticPagesTerms extends Controller
{
  public function index()
  {
    $isAdmin = Helpers::isAdmin();
    if(!$isAdmin){
      return Redirect::back()->withErrors([
        "msg" => "You are not authorized",
      ]);
    }

    $page = Page::where('slug', '=', 'terms-condition')->first();

    $staticPagePrivacyUrl = route('static-pages-privacy');
    $staticPageTermsUrl = route('static-pages-terms');

    $slug = "terms-condition";
    $title = "Terms & conditions";
    $currentUrl = request()->route()->getName();
    return view('content.pages.pages-static-pages-privacy', [
      'staticPagePrivacyUrl' => $staticPagePrivacyUrl,
      'staticPageTermsUrl' => $staticPageTermsUrl,
      'page' => $page,
      'slug' => $slug,
      'title' => $title,
      'currentUrl' => $currentUrl,
    ]);
  }
}
