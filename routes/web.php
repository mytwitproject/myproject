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
Thujohn\Twitter\TwitterServiceProvider::class ;

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



        $response = Twitter::getTrendsPlace(['id'=>455819]);
    }
    catch (Exception $e)
    {
        // dd(Twitter::error());
        dd(Twitter::logs());
    }

    dd($response);
});
Route::get('/search', function()
{
    try
    {


        $response = Twitter::getSearch(['q'=>"#محسن_حججی"]);
        echo json_encode($response);
    }
    catch (Exception $e)
    {
        // dd(Twitter::error());
        dd(Twitter::logs());
    }

    dd($response);
});

Route::post('/trensbyhashtag',['as' => 'trensbyhashtag', 'uses' =>'MainController@trendsbyhashtag']);
