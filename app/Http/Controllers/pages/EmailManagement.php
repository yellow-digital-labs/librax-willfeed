<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailHistory;

class EmailManagement extends Controller
{
  public function index()
  {
    $email_history = EmailHistory::where([])
      ->orderBy("id", "desc")
      ->get();
    return view('content.pages.pages-email-management', [
      'email_history' => $email_history
    ]);
  }
}
