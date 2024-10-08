<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LandingPage extends Controller
{
    public function view(Request $request)
    {
        //get seller's active products by region and from minimum pricing
        $product_price = DB::table('product_sellers')
            ->select('regions.name as title', 'regions.lat as latitude', 'regions.long as longitude', 'product_sellers.product_name as type')
            ->selectRaw('MIN(product_sellers.amount) AS value')
            ->leftJoin('user_details', 'user_details.user_id', 'product_sellers.seller_id')
            ->leftJoin('regions', function($join){
                $join->whereRaw(DB::raw("FIND_IN_SET(regions.name, user_details.geographical_coverage_regions)"));
            })
            ->where('product_sellers.status', 'active')
            ->groupBy('product_sellers.product_name', 'regions.name')
            ->get()->toArray();

        foreach($product_price as $key => $_product_price){
            $product_price[$key]->productColor = "#a3791f";
            $product_price[$key]->latitude = (float)($_product_price->latitude);
            $product_price[$key]->longitude = (float)($_product_price->longitude);
        }

        $products = array_unique(array_map(function ($i) { return $i->type; }, $product_price));

        return view("content.pages.landing-page", ['product_price' => $product_price, 'products' => $products]);
    }
}
