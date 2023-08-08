<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ClientController extends Controller
{
  public function logout()
  {
    Auth::logout();
    return redirect('/')->with(['msg_body' => 'You signed out!']);
  }
}
