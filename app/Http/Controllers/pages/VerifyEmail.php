<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\UserVerification;
use Auth;

class VerifyEmail extends Controller
{
  public function index()
  {
    $email = Auth::user()->email;
    $user_id = Auth::user()->id;

    $pageConfigs = ["myLayout" => "blank"];
    $user = User::where("id", "=", $user_id)->first();

    if(empty($user->email_verified_at)){
      return view("content.pages.pages-verify-email", [
        "pageConfigs" => $pageConfigs,
        "email" => $email,
      ]);
    } else {
      return redirect()->route("dashboard");
    }
  }

  public function confirm(Request $request, $token)
  {
    $user = User::where("verification_token", "=", $token)
      ->where("varification_valid_till", ">=", date("Y-m-d H:i:s", strtotime('-24 hours', time())))
      ->first();

    if($user){
      $user->update([
        "email_verified_at" => date("Y-m-d H:i:s")
      ]);

      return redirect()->route("dashboard");
    } else {
      return redirect()->route("verify-email")->withErrors(["msg" => "Invalid link or link has been expired. Please try again to validating the email by clicking the resend email button."]);
    }
  }

  public function resend(){
    $user_id = Auth::user()->id;
    $user = User::where("id", "=", $user_id)->first();

    $verificationUrl = route("verify-email-confirm", ["token" => $user->verification_token]);

    //send email
    Mail::to($user->email)->send(new UserVerification([
        "accountTypeName" => $user->accountTypeName,
        "verificationUrl" => $verificationUrl
    ]));

    return redirect()->route("verify-email")->withErrors(["msg" => "Verification email has been sent again, Please check your inbox."]);
  }
}
