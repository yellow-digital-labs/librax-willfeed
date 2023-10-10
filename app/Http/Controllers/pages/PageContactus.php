<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactUs;

class PageContactus extends Controller
{
  public function index()
  {
    return view('content.pages.pages-contactus');
  }

  public function store(Request $request){
    $validator = Validator::make($request->all(), [
        "name" => "required",
        "email" => "required",
        "mobile" => "required",
        "message" => "required",
    ]);

    if ($validator->fails()) {
        $key = array_keys($validator->errors()->messages());
        return $this->sendError(
            implode(",", $validator->errors()->messages()[$key[0]])
        );
    }

    Mail::to(env("MAIL_TO_ADDRESS"))->send(new ContactUs([
        "name" => $request->name,
        "email" => $request->email,
        "mobile" => $request->mobile,
        "message" => $request->message,
    ]));

    return redirect()->route('pages-contactus-thankyou');
  }

  public function thankyou(){
    return view('content.pages.pages-contactus-thankyou');
  }
}
