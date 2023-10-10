<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailHistory;
use App\Helpers\Helpers;
use Redirect;

class EmailManagement extends Controller
{
  public function index()
  {
    $isAdmin = Helpers::isAdmin();
    if(!$isAdmin){
      if(!$isAdmin){
        return Redirect::back()->withErrors([
          "msg" => "You are not authorized",
        ]);
      }
    }

    $email_history = EmailHistory::where([])
      ->orderBy("id", "desc")
      ->get();
    return view('content.pages.pages-email-management', [
      'email_history' => $email_history
    ]);
  }

  public function detail(Request $request, $id){
    $isAdmin = Helpers::isAdmin();
    if(!$isAdmin){
      return response()->json([
        "message" => "You are not authorized",
        "code" => 500,
        "data" => [],
      ]);
    }

    $email = EmailHistory::where("id", "=", $id)->first();
    $email['total'] = EmailHistory::count();

    if($email) {
      return response()->json([
        "message" => "Successfully fetched data",
        "code" => 200,
        "data" => $email,
      ]);
    } else {
      return response()->json([
        "message" => "No data found",
        "code" => 500,
        "data" => [],
      ]);
    }
  }
}
