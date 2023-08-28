<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StaticPagesPrivacy extends Controller
{
  public function index()
  {
    $staticPagePrivacyUrl = route('static-pages-privacy');
    $staticPageTermsUrl = route('static-pages-terms');

    return view('content.pages.pages-static-pages-privacy', [
      'staticPagePrivacyUrl' => $staticPagePrivacyUrl,
      'staticPageTermsUrl' => $staticPageTermsUrl,
    ]);
  }
}
