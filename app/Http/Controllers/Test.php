<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserVerification;

class Test extends Controller
{
    public function index(){
        echo date("Y-m-d H:i:s");die;
        Mail::to('tejas.ambalia1994@gmail.com')->send(new UserVerification([
            "accountTypeName" => 'Seller',
            "verificationUrl" => 'google.com'
        ]));
    }
}
