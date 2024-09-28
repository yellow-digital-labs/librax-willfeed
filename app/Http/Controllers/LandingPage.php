<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingPage extends Controller
{
    public function view(Request $request)
    {
        return view("content.pages.landing-page", []);
    }
}
