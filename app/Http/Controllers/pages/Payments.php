<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionPayment;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use App\Helpers\Helpers;
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
    $isAdmin = Helpers::isAdmin();
    $user_id = Auth::user()->id;
    $columns = [
      1 => "subscription_payments.id",
      2 => "transaction_datetime",
      3 => "user_name",
      4 => "email",
      5 => "subscription_payments.subscription_amount",
      6 => "card",
      7 => "transaction_no",
      8 => "subscription_payments.status",
    ];

    $search = [];

    if($isAdmin){
      $f = SubscriptionPayment::where([])
        ->leftjoin("users", "users.id", "subscription_payments.user_id");
    } else {
      $f = SubscriptionPayment::where("user_id", "=", $user_id)
        ->leftjoin("users", "users.id", "subscription_payments.user_id");
    }
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
        if($isAdmin){
          $customersObj = SubscriptionPayment::where([])
            ->leftjoin("users", "users.id", "subscription_payments.user_id");
        } else {
          $customersObj = SubscriptionPayment::where("user_id", "=", $user_id)
            ->leftjoin("users", "users.id", "subscription_payments.user_id");
        }

        foreach ($applied_filters as $field => $search) {
          $customersObj->where($field, "LIKE", "%{$search}%");
        }

        $customers = $customersObj
          ->selectRaw("users.*, subscription_payments.*")
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      } else {
        if($isAdmin){
          $q = SubscriptionPayment::where([])
            ->leftjoin("users", "users.id", "subscription_payments.user_id");
        } else {
          $q = SubscriptionPayment::where("user_id", "=", $user_id)
            ->leftjoin("users", "users.id", "subscription_payments.user_id");
        }
        $customers = $q
          ->selectRaw("users.*, subscription_payments.*")
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      }
    } else {
      $search = $request->input("search.value");

      if($isAdmin){
        $q = SubscriptionPayment::where(function ($query) use ($search) {
            return $query
              ->where("subscription_payments.transaction_datetime", "LIKE", "%{$search}%")
              ->orWhere("subscription_payments.subscription_amount", "LIKE", "%{$search}%")
              ->orWhere("subscription_payments.card", "LIKE", "%{$search}%")
              ->orWhere("subscription_payments.transaction_no", "LIKE", "%{$search}%")
              ->orWhere("subscription_payments.status", "LIKE", "%{$search}%")
              ->orWhere("subscription_payments.user_name", "LIKE", "%{$search}%")
              ->orWhere("users.email", "LIKE", "%{$search}%");
          })
          ->leftjoin("users", "users.id", "subscription_payments.user_id");
      } else {
        $q = SubscriptionPayment::where("user_id", "=", $user_id)
          ->where(function ($query) use ($search) {
            return $query
              ->where("subscription_payments.transaction_datetime", "LIKE", "%{$search}%")
              ->orWhere("subscription_payments.subscription_amount", "LIKE", "%{$search}%")
              ->orWhere("subscription_payments.card", "LIKE", "%{$search}%")
              ->orWhere("subscription_payments.transaction_no", "LIKE", "%{$search}%")
              ->orWhere("subscription_payments.status", "LIKE", "%{$search}%")
              ->orWhere("subscription_payments.user_name", "LIKE", "%{$search}%")
              ->orWhere("users.email", "LIKE", "%{$search}%");
          })
          ->leftjoin("users", "users.id", "subscription_payments.user_id");
      }

      $customers = $q
        ->selectRaw("users.*, subscription_payments.*")
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();

      $totalFiltered = $q
        ->count();
    }

    $data = [];

    if (!empty($customers)) {
      // providing a dummy id instead of database ids
      $ids = $start;

      foreach ($customers as $customer) {
        $nestedData["id"] = $customer->id;
        $nestedData["fake_id"] = ++$ids;
        $nestedData["transaction_datetime"] = date('d-m-Y H:i', strtotime($customer->transaction_datetime));
        $nestedData["subscription_amount"] = "€".formatAmountForItaly($customer->subscription_amount);
        $nestedData["user_name"] = $customer->user_name;
        $nestedData["email"] = $customer->email;
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
