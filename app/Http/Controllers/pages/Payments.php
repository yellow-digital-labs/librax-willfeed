<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionPayment;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use Exception;
use Auth;

class Payments extends Controller
{
  public function index()
  {
    $urlListPaymentData = route("payment-list");

    return view('content.pages.pages-payments', [
      'urlListPaymentData' => $urlListPaymentData
    ]);
  }

  public function list(Request $request)
  {
    $user_id = Auth::user()->id;
    $columns = [
      1 => "id",
      2 => "transaction_datetime",
      3 => "subscription_amount",
      4 => "card",
      5 => "transaction_no",
      6 => "status",
    ];

    $search = [];

    $f = SubscriptionPayment::where("user_id", "=", $user_id);
    $totalData = $f->count();

    $totalFiltered = $totalData;

    $limit = $request->input("length");
    $start = $request->input("start");
    $order = $columns[$request->input("order.0.column")];
    $dir = $request->input("order.0.dir");

    $applied_filters = [];
    foreach ($request->input("columns") as $col) {
      if (!empty($col["search"]["value"])) {
        $applied_filters[$col["data"]] = $col["search"]["value"];
      }
    }

    if (empty($request->input("search.value"))) {
      if (count($applied_filters) > 0) {
        $customersObj = SubscriptionPayment::where("user_id", "=", $user_id);

        foreach ($applied_filters as $field => $search) {
          $customersObj->where($field, "LIKE", "%{$search}%");
        }

        $customers = $customersObj
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      } else {
        $customers = SubscriptionPayment::where("user_id", "=", $user_id)
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      }
    } else {
      $search = $request->input("search.value");

      $customers = SubscriptionPayment::where("user_id", "=", $user_id)
        ->where(function ($query) {
          return $query
            ->where("transaction_datetime", "LIKE", "%{$search}%")
            ->orWhere("subscription_amount", "LIKE", "%{$search}%")
            ->orWhere("card", "LIKE", "%{$search}%")
            ->orWhere("transaction_no", "LIKE", "%{$search}%")
            ->orWhere("status", "LIKE", "%{$search}%");
        })
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();

      $totalFiltered = SubscriptionPayment::where("user_id", "=", $user_id)
        ->where(function ($query) {
          return $query
            ->where("transaction_datetime", "LIKE", "%{$search}%")
            ->orWhere("subscription_amount", "LIKE", "%{$search}%")
            ->orWhere("card", "LIKE", "%{$search}%")
            ->orWhere("transaction_no", "LIKE", "%{$search}%")
            ->orWhere("status", "LIKE", "%{$search}%");
        })
        ->count();
    }

    $data = [];

    if (!empty($customers)) {
      // providing a dummy id instead of database ids
      $ids = $start;

      foreach ($customers as $customer) {
        $nestedData["id"] = $customer->id;
        $nestedData["fake_id"] = ++$ids;
        $nestedData["transaction_datetime"] = $customer->transaction_datetime;
        $nestedData["subscription_amount"] = $customer->subscription_amount;
        $nestedData["card"] = "xxxx xxxx xxxx ".$customer->card;
        $nestedData["transaction_no"] = $customer->transaction_no;
        $nestedData["status"] = $customer->status;

        $data[] = $nestedData;
      }
    }

    if ($data) {
      return response()->json([
        "draw" => intval($request->input("draw")),
        "recordsTotal" => intval($totalData),
        "recordsFiltered" => intval($totalFiltered),
        "code" => 200,
        "data" => $data,
      ]);
    } else {
      return response()->json([
        "message" => "Internal Server Error",
        "code" => 500,
        "data" => [],
      ]);
    }
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
