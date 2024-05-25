<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ModifyEmailRequest;
use App\Mail\ModifyEmailRequest as ModifyEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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

    public function sendVerificationLink(Request $request)
    {
        $user = Auth::user();
        
         $request->validate([
            'new_email' => 'required|email|unique:users,email',
            'confirm_password' => 'required',
        ]);

        if($request->new_email === $user->email){
          return back()->withError(["new_email"=>"Enter New  Email is Same as Present email"]);
        }
      
        if (!Hash::check($request->confirm_password, $user->password)) {
            return back()->withErrors(['password' => 'The password is incorrect.']);
        }

        $token = Str::random(60);

        ModifyEmailRequest::updateOrCreate(
            ['user_id' => $user->id],
            ['new_email' => $request->new_email, 'token' => $token]
        );

        $mailData = [
          "token" => $token
        ];

        Mail::to($request->new_email)->send(new ModifyEmail($mailData));

        return back()->with('status', 'Verification link has been sent to your new email address.');
    }

    public function verifyEmail($token)
    {
        $verification = ModifyEmailRequest::where('token', $token)->firstOrFail();
        $user = User::findOrFail($verification->user_id);

        $user->email = $verification->new_email;
        $user->save();

        $verification->delete();

        return redirect()->route('settings')->with('status', 'Your email address has been successfully changed.');
    }
}
