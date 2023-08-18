<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use Exception;

class Payments extends Controller
{
  public function index()
  {
    return view('content.pages.pages-payments');
  }

  public function view()
  {
    return view('content.pages.pages-payments-view');
  }

  public function store(Request $request)
  {
    try {
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $stripe->paymentIntents->create([
            'amount' => 99 * 100,
            'currency' => 'usd',
            'payment_method' => $request->payment_method,
            'description' => 'Demo payment with stripe',
            'confirm' => true,
            'receipt_email' => $request->email
        ]);
    } catch (CardException $th) {
        throw new Exception("There was a problem processing your payment", 1);
    }

    return back()->withSuccess('Payment done.');
  }
}
