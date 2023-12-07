<?php

namespace App\Providers;

use App\Models\Course;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Stripe\StripeClient;
use Pusher\Pusher;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // pusher----
        // $this->app->bind(Pusher::class, function ($pusher) {
        //     $options = array(
        //         'cluster' => 'ap2',
        //         'useTLS' => false
        //       );
        //       return $pusher = new Pusher(
        //         env('PUSHER_APP_KEY'),
        //         env('PUSHER_APP_SECRET'),
        //         env('PUSHER_APP_ID'),
        //         $options
        //       );
        // });

        //stripe----------
        // $this->app->bind(StripeClient::class, function($stripe) {
        //     return $stripe = new StripeClient('sk_test_51GwxpWC4TmetQIXp7fiykigYXMoeXlXVabCejPgal4gr24mEJYkjr2UWKhcS40IlBQppxoUJWYAksYqiutgJa6Pj00EVYmPGG7');
        // });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        // View::share('courses', Course::where('status',1)->whereHas('sections')->get());
    }
}
