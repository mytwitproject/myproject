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
            $hashtag = @$request->hashtag;

            $response = Twitter::getSearch(['q'=>$hashtag, 'count' => 15, "tweet_mode" => "extended", ]);
            $response = $response->statuses;
            //dd($response);
            $respon = Twitter::getTweet("903981827118964736",["include_entities"=>"true","tweet_mode" => "extended"]);


            $all =[];
            foreach($response as $response=>$val){
                $tweet_image = isset($val->entities->media) ? $val->entities->media[0]->media_url:null ;
                $temp = isset($val->retweeted_status) ? $val->retweeted_status->full_text : $val->full_text;
                $temp = preg_replace("/RT /", " ", $temp);
                $temp = preg_replace("/(@.*? )/", " ", $temp);
                $temp = explode('http', $temp);
                //TODO:REMOVE EXTRA CHARACERS FROM $TEMP
                $full = ['full_text'=> $temp[0],
                    'user_name'=>$val->user->screen_name,
                    'img_url'=>$val->user->profile_image_url,
                    'tweet_img'=>$tweet_image,
                    'created_at'=>$val->created_at
                ];
                $screen_nam = $val->user->screen_name;
                $all[] = $full;
            }

            $respon = Twitter::getGeoSearch(['query'=>"Iran"]);
            $long = $respon->result->places[0]->centroid[0];
            $lat = $respon->result->places[0]->centroid[1];
            $r = $respon->result->places[0]->bounding_box->coordinates;

            //----------------------------------------getting all county name and woeid
            $respon = Twitter::getTrendsAvailable();

            dd($respon);
            //-----------------------------------------
            $respo = Twitter::getSearch(['q'=>$hashtag, 'count' => 15, "tweet_mode" => "extended",'geocode'=>"32.39654265,54.146559591075,100mi",'result_type=>"popular' ]);


            //echo json_encode($respo);
            //$full = array_unique($full);
            //return view('test',["key"=>$all]);




        }
        catch (Exception $e)
        {
            // dd(Twitter::error());
            // echo json_encode($response);
            dd(Twitter::logs());
        }

    }

}