<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Thankyou extends Controller
{
    public function signup(){
        return view("content.pages.pages-thankyou-signup");
    }
}