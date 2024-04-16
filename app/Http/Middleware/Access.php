<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class Access
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    if (
      $request->route()->action["as"] != "signup-seller" &&
      $request->route()->action["as"] != "signup-buyer"
    ) {
      if (
        Auth::check() &&
        (Auth::user()->accountType == "2" || Auth::user()->accountType == "1")
      ) {
        if (empty(Auth::user()->email_verified_at)) {
            //redirect to verify notification page
            return redirect("verify-email");
        } elseif (Auth::user()->profile_completed == "No") {
          if (Auth::user()->accountType == "2") {
            return redirect()->route("signup-seller");
          } elseif (Auth::user()->accountType == "1") {
            return redirect()->route("signup-client");
          }
        } elseif (Auth::user()->approved_by_admin == "Pending"){
          return redirect()->route("thankyou-signup");
        } elseif (Auth::user()->approved_by_admin == "No"){
          return redirect()->route("reject-signup");
        }

        if($request->route()->action['as'] != 'profile' && $request->route()->action['as'] != 'stripe.post' && $request->route()->action['as'] != 'stripe.payment.delete' && $request->route()->action['as'] != 'plan-update') {
          if(Auth::check()) {
            
            $exp_date = strtotime(Auth::user()->exp_datetime);
            $curr_date = strtotime(date("Y-m-d"));
            
            if($exp_date < $curr_date){
              //redirect to profile page
              return redirect()->route("profile", ["expired" => "true"]);
            }
          }
        }
      }
    }

    return $next($request);
  }
}
