<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerGroup;
use App\Helpers\Helpers;
use Auth;

class CustomerGroupManagementController extends Controller
{
    public function index()
    {
        $isSeller = Helpers::isSeller();
        if(!$isSeller){
            return Redirect::back()->withErrors([
                "msg" => "You are not authorized",
            ]);
        }

        $urlListSubscribeData = route("customer-group-management-list");

        return view('content.pages.pages-customer-group-management', [
            "urlListSubscribeData" => $urlListSubscribeData,
        ]);
    }

    public function list(Request $request){
        $isSeller = Helpers::isSeller();
        $user_id = Auth::user()->id;
        if(!$isSeller){
            return Redirect::back()->withErrors([
                "msg" => "You are not authorized",
            ]);
        }

        $columns = [
            0 => "customer_group_name",
            1 => "status",
        ];

        $search = [];

        $f = CustomerGroup::where([]);
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
                $customersObj = CustomerGroup::where([]);
                
                foreach ($applied_filters as $field => $search) {
                $customersObj->where($field, "LIKE", "%{$search}%");
                }

                $customers = $customersObj
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            } else {
                $customers = CustomerGroup::where([])
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            }
        } else {
            $search = $request->input("search.value");

            $q = CustomerGroup::where(function ($query) use ($search) {
                return $query
                ->where("customer_group_name", "LIKE", "%{$search}%")
                ->orWhere("status", "LIKE", "%{$search}%");
            });
            $customers = $q
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
                $nestedData["customer_group_name"] = $customer->customer_group_name;
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

    public function add(Request $request)
    {
        $subscription = CustomerGroup::create([
            "customer_group_name" => $request->customer_group_name,
            "status" => $request->status?'active':'inactive',
        ]);

        return redirect()->back();
        // return response()->json($subscription);
    }

    public function edit($id)
    {
        $subscription = CustomerGroup::where(['id' => $id])->first();

        return response()->json($subscription);
    }

    public function store(Request $request, $id)
    {
        $subscription = CustomerGroup::where(['id' => $id])->update([
            "customer_group_name" => $request->customer_group_name,
            "status" => $request->status?'active':'inactive',
        ]);

        return redirect()->back();
        // return response()->json($subscription);
    }
}
