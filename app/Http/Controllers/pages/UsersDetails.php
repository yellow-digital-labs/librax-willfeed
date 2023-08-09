<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserDetail;
use Auth;

class UsersDetails extends Controller
{
  public function index()
  {
    $user = Auth::user();
    $user_detail = UserDetail::where(['user_id' => $user->id])->first();

    return view('content.pages.pages-users-details', [
      'user' => $user,
      'user_detail' => $user_detail
    ]);
  }
}
