<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Helpers\Helpers;
use Auth;

class StaticPagesPrivacy extends Controller
{
  public function index()
  {
    $isAdmin = Helpers::isAdmin();
    if(!$isAdmin){
      return Redirect::back()->withErrors([
        "msg" => "You are not authorized",
      ]);
    }

    $page = Page::where('slug', '=', 'privacy-policy')->first();

    $staticPagePrivacyUrl = route('static-pages-privacy');
    $staticPageTermsUrl = route('static-pages-terms');

    $slug = "privacy-policy";
    return view('content.pages.pages-static-pages-privacy', [
      'staticPagePrivacyUrl' => $staticPagePrivacyUrl,
      'staticPageTermsUrl' => $staticPageTermsUrl,
      'page' => $page,
      'slug' => $slug,
    ]);
  }

  public function save(Request $request)
  {
    $isAdmin = Helpers::isAdmin();
    if(!$isAdmin){
      return Redirect::back()->withErrors([
        "msg" => "You are not authorized",
      ]);
    }

    if($request->slug){
      $slug = $request->slug;
    } else {
      $slug = Helpers::generateSlug($request->page_name);
    }

    Page::updateOrCreate(
      [
        "slug" => $slug,
      ],
      [
        "page_name" => $request->page_name,
        "description" => $request->description,
        "meta_title" => $request->meta_title,
        "meta_keyword" => $request->meta_keyword,
        "meta_description" => $request->meta_description,
      ]
    );

    return redirect()->back();
  }
}
