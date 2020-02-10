<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Good;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\GoodPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {

            $token = $request->input('api_token',  $request->bearerToken());

            if(!empty($token)
                && ($user = User::whereApiToken($token)->first()))
                return $user;

            return null;
        });

        Gate::policy(Category::class, CategoryPolicy::class);
        Gate::policy(Good::class, GoodPolicy::class);
    }
}
