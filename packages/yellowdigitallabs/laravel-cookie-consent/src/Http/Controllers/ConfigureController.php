<?php

namespace Whitecube\LaravelCookieConsent\Http\Controllers;

use Whitecube\LaravelCookieConsent\CookiesManager;
use Illuminate\Http\Request;
use App\Models\CookieModel;

class ConfigureController
{
    public function __invoke(Request $request, CookiesManager $cookies)
    {
        $categories = collect($request->get('categories', []))
            ->prepend('essentials')
            ->unique()
            ->filter(fn($key) => $cookies->hasCategory($key))
            ->values()
            ->all();

        if($request->user()){
            $user_type = $request->user()->accountTypeName . ' | ' . $request->user()->name;

            CookieModel::updateOrCreate([
                'user_id' => $request->user()->id,
                'ip_address' =>  $request->ip(),
            ],
            [
                'user_id' => $request->user()->id,
                'user_name' => $user_type,
                'consents' => implode(', ', $categories),
                'created_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            $user_type = 'Guest';

            CookieModel::updateOrCreate([
                'ip_address' =>  $request->ip(),
            ], [
                'user_name' => $user_type,
                'consents' => implode(', ', $categories),
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        return $cookies->accept($categories)->toResponse($request);
    }
}
