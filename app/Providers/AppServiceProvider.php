<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Thujohn\Twitter\Facades\Twitter;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

//        if(env('APP_ENV')=="local"){
//            Twitter::reconfig([
//                //fiddler
//                'curl_ssl_verifyhost'        => 0,
//                'curl_ssl_verifypeer'        => false,
//                'curl_proxy'                 => 'https://127.0.0.1:8580'
//            ]);
//        }
    }

}
