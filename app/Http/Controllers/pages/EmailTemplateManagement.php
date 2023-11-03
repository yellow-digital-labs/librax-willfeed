<?php

namespace App\Http\Controllers\pages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\MailTemplate;
use App\Helpers\Helpers;
use Auth;
use DB;
use Redirect;

class EmailTemplateManagement extends Controller
{
  public function index()
  {
    $isAdmin = Helpers::isAdmin();
    $user_id = Auth::user()->id;

    if(!$isAdmin){
      return redirect()->route("dashboard");
    }
    $urlListProductData = route("email-template-management-list");

    return view("content.pages.pages-email-template", [
      "urlListProductData" => $urlListProductData,
    ]);
  }

  public function list(Request $request)
  {
    $isAdmin = Helpers::isAdmin();
    $user_id = Auth::user()->id;
    $columns = [
      3 => "id",
      0 => "template",
      1 => "subject",
      2 => "email_for",
    ];

    $search = [];

    $f = MailTemplate::where([]);
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
        $productsObj = MailTemplate::where([]);
        
        foreach ($applied_filters as $field => $search) {
          $productsObj->where($field, "LIKE", "%{$search}%");
        }

        $products = $productsObj
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      } else {
        $q = MailTemplate::where([]);

        $products = $q
          ->offset($start)
          ->limit($limit)
          ->orderBy($order, $dir)
          ->get();
      }
    } else {
      $search = $request->input("search.value");

      $q = MailTemplate::where([]);

      $products = $q
        ->where(function ($query) use ($search) {
          return $query
            ->where("mailable", "LIKE", "%{$search}%")
            ->orWhere("subject", "LIKE", "%{$search}%")
            ->orWhere("email_for", "LIKE", "%{$search}%");
        })
        ->offset($start)
        ->limit($limit)
        ->orderBy($order, $dir)
        ->get();

      $totalFiltered = $q
        ->where(function ($query) use ($search) {
          return $query
            ->where("mailable", "LIKE", "%{$search}%")
            ->orWhere("subject", "LIKE", "%{$search}%")
            ->orWhere("email_for", "LIKE", "%{$search}%");
        })
        ->count();
    }

    $data = [];

    if (!empty($products)) {
      // providing a dummy id instead of database ids
      $ids = $start;

      foreach ($products as $product) {
        $nestedData["id"] = $product->id;
        $nestedData["fake_id"] = ++$ids;
        $nestedData["mailable"] = $product->template;
        $nestedData["email_for"] = $product->email_for;
        $nestedData["subject"] = $product->subject;

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

  public function edit(Request $request, $id){
    $template = MailTemplate::where(["id" => $id])->first();

    if($template){
      $variables = explode(",", $template->variables);
      return view("content.pages.pages-email-template-management-edit", [
        "template" => $template,
        "variables" => $variables,
      ]);
    } else {
      return redirect()->route("dashboard");
    }
  }

  public function update(Request $request, $id){
    $template = MailTemplate::where(["id" => $id])->first();

    if($template){
      MailTemplate::where(["id" => $id])->update([
        "template" => $request->template,
        "subject" => $request->subject,
        "html_template" => $request->html_template,
      ]);

      return redirect()->route("email-template-management");
    } else {
      return redirect()->route("dashboard");
    }
  }
}
