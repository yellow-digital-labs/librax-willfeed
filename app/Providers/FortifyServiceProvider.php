<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse;
use App\Models\AccountType;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->instance(LoginResponse::class, new class implements LoginResponse {
            public function toResponse($request)
            {
                return redirect()->route("dashboard");
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::registerView(function (Request $request) {
            $pageConfigs = ['myLayout' => 'blank'];
            $accountType = AccountType::all();
            $defaultType = 0;
            if($request->get('type')){
                if($request->get('type') == 'buyer'){
                    $defaultType = 1;
                } elseif($request->get('type') == 'seller'){
                    $defaultType = 2;
                }
            }

            return view('content.pages.pages-signup', [
                'pageConfigs' => $pageConfigs,
                'accountType' => $accountType,
                'defaultType' => $defaultType,
            ]);
        });

        Fortify::loginView(function () {
            $pageConfigs = ['myLayout' => 'blank'];
            $isAdmin = false;
            return view('content.pages.pages-login', [
            'pageConfigs' => $pageConfigs,
            'isAdmin' => $isAdmin
            ]);
        });

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
