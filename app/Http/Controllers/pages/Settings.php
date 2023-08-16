<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;

class Settings extends Controller
{
  public function index()
  {
    return view("content.pages.pages-settings");
  }

  public function store(Request $request)
  {
    $user_id = Auth::user()->id;

    dd(Hash::make($request->old_password));

    $user_avail = User::where([
      "id" => $user_id,
      "password" => Hash::make($request->old_password),
    ])->count();

    if($user_avail>0){
      //update password
      User::where([
        "id" => $user_id,
      ])->update([
        "password" => Hash::make($request->password)
      ]);

      return redirect()->route("settings")->with(["msg" => "Password updated successfully"]);
    } else {
      //error
      return redirect()->route("settings")->withErrors(["msg" => "Old password is wrong"]);
    }
  }
}
