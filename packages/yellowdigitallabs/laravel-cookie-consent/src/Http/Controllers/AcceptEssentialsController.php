<?php

namespace Whitecube\LaravelCookieConsent\Http\Controllers;

use Whitecube\LaravelCookieConsent\CookiesManager;
use Illuminate\Http\Request;
use App\Models\CookieModel;

class AcceptEssentialsController
{
    public function __invoke(Request $request, CookiesManager $cookies)
    {
        if($request->user()){
            $user_type = $request->user()->accountTypeName . ' | ' . $request->user()->name;

            CookieModel::updateOrCreate([
                'user_id' => $request->user()->id,
            ],
            [
                'user_id' => $request->user()->id,
                'user_name' => $user_type,
                'consents' => 'Rejected All',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            $user_type = 'Guest';

            CookieModel::insert([
                'user_name' => $user_type,
                'consents' => 'Rejected All',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }
        return $cookies->accept(['essentials'])->toResponse($request);
    }
}
