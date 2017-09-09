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
Route::get('/home',['as'=>'home','uses'=>'MainController@Most_recent']);

Route::get('/child', function () {
    return view('child');
});

Route::get('/master','MainController@get_country');
Route::get('/geo','MainController@geo');

Route::get('/content',function (){
    return view('content');
});
Route::get('country','MainController@get_country');
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
