<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class VerifiedUser
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    if (
      Auth::check() &&
      (Auth::user()->accountType == "2" || Auth::user()->accountType == "1")
    ) {
      if (empty(Auth::user()->email_verified_at)) {
        //redirect to verify notification page
        return redirect("verify-email");
      }
    }

    return $next($request);
  }
}
