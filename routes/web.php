<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});
Route::get('/child', function () {
    return view('child');
});
Route::get('/master',function (){
    return view('master');
});
Route::get('/tweet', function()
{
    try
    {

        Twitter::reconfig([
            //fiddler
            'curl_ssl_verifyhost'        => 0,
            'curl_ssl_verifypeer'        => false,
            'curl_proxy'                 => 'https://127.0.0.1:8580'
        ]);
        $response = Twitter::getTrendsAvailable();
    }
    catch (Exception $e)
    {
        // dd(Twitter::error());
        dd(Twitter::logs());
    }

    dd($response);
});
