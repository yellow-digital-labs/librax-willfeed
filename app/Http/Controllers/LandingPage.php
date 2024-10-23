<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helpers;
use DB;
use Auth;

class LandingPage extends Controller
{
    public function view(Request $request)
    {
        $user = Auth::user();
        $isLoggedIn = false;
        $isBuyer = false;
        if($user){
            $isLoggedIn = true;
            $isBuyer = Helpers::isBuyer();
        }
        //get seller's active products by region and from minimum pricing

        $product_query = DB::table('product_sellers')
            ->select('regions.name as title', 'regions.lat as latitude', 'regions.long as longitude', 'product_sellers.product_name as type', 'products.map_color as productColor')
            ->selectRaw('MIN(product_sellers.amount_before_tax) AS value')
            ->leftJoin('user_details', 'user_details.user_id', 'product_sellers.seller_id')
            ->join('products', 'products.id', 'product_sellers.product_id')
            ->leftJoin('regions', function($join){
                $join->whereRaw(DB::raw("FIND_IN_SET(regions.name, user_details.geographical_coverage_regions)"));
            })
            ->where('product_sellers.status', 'active')
            ->orderBy('product_sellers.amount_before_tax', 'asc')
            ->groupBy('product_sellers.product_name', 'regions.name');

        if($isBuyer){
            $product_query->join('customer_verifieds as cv', function($join) use ($user){
                $join->where('cv.customer_id', '=', $user->id);
                $join->on('cv.customer_group', '=', 'product_sellers.customer_groups_id');
            });
        } else {
            $product_query->where('product_sellers.customer_groups_id', '=', 0);
        }

        $product_price = $product_query->get()->toArray();
        
        foreach($product_price as $key => $_product_price){
            // $product_price[$key]->productColor = "#a3791f";
            $product_price[$key]->value = formatAmountForItaly($_product_price->value)."€/l";
            $product_price[$key]->latitude = (float)($_product_price->latitude);
            $product_price[$key]->longitude = (float)($_product_price->longitude);
        }

        $tempArr = array_unique(array_column($product_price, 'type'));
        $products = array_intersect_key($product_price, $tempArr);

        return view("content.pages.landing-page", ['product_price' => $product_price, 'products' => $products, 'isLoggedIn' => $isLoggedIn]);
    }
}

