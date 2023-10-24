<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserVerification;

class Test extends Controller
{
    public function index(){
        dd("");
        $to = explode(',', env('MAIL_TO_ADDRESS'));
        Mail::to($to)->send(new UserVerification([
            "accountTypeName" => 'Seller',
            "verificationUrl" => 'google.com'
        ]));
    }
}
