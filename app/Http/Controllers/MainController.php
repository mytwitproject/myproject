<?php
/**
 * Created by PhpStorm.
 * User: Tina Re
 * Date: 8/25/2017
 * Time: 8:44 PM
 */
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\HttpFoundation\Request;
use Thujohn\Twitter\Facades\Twitter;
class MainController extends Controller{

    public function trendsbyhashtag(Request $request){
        try
        {

            Twitter::reconfig([
                //fiddler
                'curl_ssl_verifyhost'        => 0,
                'curl_ssl_verifypeer'        => false,
                'curl_proxy'                 => 'https://127.0.0.1:8580'
            ]);
            $hashtag = @$request->hashtag;

            $response = Twitter::getSearch(['q'=>$hashtag, 'count' => 15, "tweet_mode" => "extended", ]); //darkhaste asli ine dg

            $response = $response->statuses;
            // echo json_encode($response);
            //dd($response);

            $all = [];
            foreach($response as $response=>$val){
                $temp = isset($val->retweeted_status) ? $val->retweeted_status->full_text : $val->full_text;
                $temp = preg_replace("/RT /", " ", $temp);
                $temp = preg_replace("/(@.*? )/", " ", $temp);
                $temp = explode('http', $temp);
                //TODO:REMOVE EXTRA CHARACERS FROM $TEMP
                $full = ['full_text'=> $temp[0],
                    'user-name'=>$val->user->screen_name,
                    'img_url'=>$val->user->profile_image_url
                ];
                $all[] = $full;
            }
            //echo json_encode($all);
            // $full = array_unique($full);
            return view('test',["key"=>$response]);
            dd($all);
            //dd($response);
        }
        catch (Exception $e)
        {
            // dd(Twitter::error());
            // echo json_encode($response);
            dd(Twitter::logs());
        }

    }

}