<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Subscription;
use Auth;

class UsersDetails extends Controller
{
  public function index()
  {
    $user = Auth::user();
    $user_detail = UserDetail::where(['user_id' => $user->id])->first();
    $subscriptions = Subscription::where(['status' => 'active'])->get();
    $isOnlyProfile = false;

    return view('content.pages.pages-users-details', [
      'user' => $user,
      'user_detail' => $user_detail,
      'subscriptions' => $subscriptions,
      'isOnlyProfile' => $isOnlyProfile,
      'authUser' => $user,
    ]);
  }

  public function view($id)
  {
    $authUser = Auth::user();
    $user_id = Auth::user()->id;
    $user = User::where(['id' => $id])->first();
    $user_detail = UserDetail::where(['user_id' => $id])->first();

    $subscriptions = [];
    $isOnlyProfile = true;
    if($user_id == $id){
      $isOnlyProfile = false;
      $subscriptions = Subscription::where(['status' => 'active'])->get();
    }

    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.pages.pages-users-details', [
      'pageConfigs' => $pageConfigs,
      'user' => $user,
      'user_detail' => $user_detail,
      'subscriptions' => $subscriptions,
      'isOnlyProfile' => $isOnlyProfile,
      'authUser' => $authUser,
    ]);
  }
}
