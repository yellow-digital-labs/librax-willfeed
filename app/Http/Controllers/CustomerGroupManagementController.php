<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerGroup;
use App\Models\CustomerVerified;
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
        ];

        $search = [];

        $f = CustomerGroup::where([
            "vendor_id" => $user_id,
        ]);
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
                $customersObj = CustomerGroup::where([
                    "vendor_id" => $user_id,
                ]);
                
                foreach ($applied_filters as $field => $search) {
                $customersObj->where($field, "LIKE", "%{$search}%");
                }

                $customers = $customersObj
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            } else {
                $customers = CustomerGroup::where([
                    "vendor_id" => $user_id,
                ])
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            }
        } else {
            $search = $request->input("search.value");

            $q = CustomerGroup::where(function ($query) use ($search) {
                return $query
                ->where("customer_group_name", "LIKE", "%{$search}%");
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
        $user_id = Auth::user()->id;
        $subscription = CustomerGroup::create([
            "vendor_id" => Auth::user()->id,
            "customer_group_name" => $request->customer_group_name,
        ]);

        if($request->customers){
            foreach($request->customers as $customer){
                CustomerVerified::where([
                    "seller_id" => $user_id,
                    "customer_id" => $customer,
                ])->update([
                    "customer_group" => $subscription->id
                ]);
            }
        }

        return redirect()->route('customer-group-management');
        // return response()->json($subscription);
    }

    public function create(){
        $user_id = Auth::user()->id;
        $customers = CustomerVerified::select(["users.*"])
            ->join("users", "users.id", "=", "customer_verifieds.customer_id")
            ->where("customer_verifieds.seller_id", "=", $user_id)
            ->where("customer_group", "=", "0")
            ->get();
            
        return view('content.pages.pages-customer-group-management-create', [
            "customers" => $customers,
            "customer_group" => 0,
            "subscription" => []
        ]);
    }

    public function edit($id)
    {
        $user_id = Auth::user()->id;
        $subscription = CustomerGroup::where(['id' => $id])->first();

        $customers = CustomerVerified::select(["users.*", "customer_verifieds.customer_group"])
            ->join("users", "users.id", "=", "customer_verifieds.customer_id")
            ->where("customer_verifieds.seller_id", "=", $user_id)
            ->where(function ($query) use ($subscription) {
                return $query
                  ->where("customer_group", "=", "0")
                  ->orWhere("customer_group", "=", $subscription->id);
            })
            ->get();

        return view('content.pages.pages-customer-group-management-create', [
            "subscription" => $subscription,
            "customers" => $customers,
            "customer_group" => $id,
        ]);
    }

    public function store(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $subscription = CustomerGroup::where(['id' => $id])->update([
            "vendor_id" => $user_id,
            "customer_group_name" => $request->customer_group_name,
        ]);

        CustomerVerified::where([
            "seller_id" => $user_id,
            "customer_group" => $id,
        ])->update([
            "customer_group" => 0,
        ]);

        if($request->customers){
            foreach($request->customers as $customer){
                CustomerVerified::where([
                    "seller_id" => $user_id,
                    "customer_id" => $customer,
                ])->update([
                    "customer_group" => $id
                ]);
            }
        }

        return redirect()->route('customer-group-management');
        // return response()->json($subscription);
    }

    public function delete($id){
        $user = Auth::user();

        $assigned = CustomerVerified::where([
            'customer_group' => $id
        ])->count();

        if($assigned > 0){
            return response()->json([
                "message" => "Customer group is assigned to customer. You can not delete this",
                "code" => 201,
                "data" => [],
            ]);
        } else {
            CustomerGroup::where([
                "id" => $id,
            ])->delete();
        
            return response()->json([
                "message" => "Customer group deleted successfully",
                "code" => 200,
                "data" => [],
            ]);
        }
      }
}
