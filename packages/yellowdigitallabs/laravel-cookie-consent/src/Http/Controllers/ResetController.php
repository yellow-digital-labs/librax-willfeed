<?php

namespace Whitecube\LaravelCookieConsent\Http\Controllers;

use Whitecube\LaravelCookieConsent\CookiesManager;
use Illuminate\Http\Request;
use App\Models\CookieModel;

class ResetController
{
    public function __invoke(Request $request, CookiesManager $cookies)
    {
        $response = ! $request->expectsJson()
            ? redirect()->back()
            : response()->json([
                'status' => 'ok',
                'scripts' => $cookies->getNoticeScripts(true),
                'notice' => $cookies->getNoticeMarkup(),
            ]);

        if($request->user()){
            $user_type = $request->user()->accountTypeName . ' | ' . $request->user()->name;

            CookieModel::updateOrCreate([
                'user_id' => $request->user()->id,
            ],
            [
                'user_id' => $request->user()->id,
                'user_name' => $user_type,
                'consents' => 'Reset',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            $user_type = 'Guest';

            CookieModel::insert([
                'user_name' => $user_type,
                'consents' => 'Reset',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        return $response->withoutCookie(
            cookie: config('cookieconsent.cookie.name'),
            domain: config('cookieconsent.cookie.domain'),
        );
    }
}
