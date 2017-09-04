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
            $hashtag = $request->hashtag;
            $response = Twitter::getSearch(['q'=>$hashtag, 'count' => 15, "tweet_mode" => "extended", ]);
            $response = $response->statuses;
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
                $all[] = $full;
            }

            $respon = Twitter::getGeoSearch(['query'=>"Turkey"]);

            $long = $respon->result->places[0]->centroid[0];
            $lat = $respon->result->places[0]->centroid[1];
            $corner_long = $respon->result->places[0]->bounding_box->coordinates['0']['0']['0'];
            $corner_lat = $respon->result->places[0]->bounding_box->coordinates['0']['0']['1'];
            $earthRadius = 3959;
            //-----------------------------------------------getting the distance between center and corner in mile

            $latFrom = deg2rad($lat);
            $lonFrom = deg2rad($long);
            $latTo = deg2rad($corner_lat);
            $lonTo = deg2rad($corner_long);

            $latDelta = $latTo - $latFrom;
            $lonDelta = $lonTo - $lonFrom;

            $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
            $distance = $angle * $earthRadius;



            $respo = Twitter::getSearch(['q'=>$hashtag, 'count' => 15, "tweet_mode" => "extended",'geocode'=>"32.39654265,54.146559591075,100mi",'result_type=>"popular' ]);


            //echo json_encode($respo);
            //$full = array_unique($full);
            return view('content',["key"=>$all]);

        }
        catch (Exception $e)
        {
            // dd(Twitter::error());
            // echo json_encode($response);
            dd(Twitter::logs());
        }

    }

    public function Most_recent(){//----------------------------------------------------------getting 10 top trend
        $respons = Twitter::getTrendsPlace(['id'=>1]);
        $respons = $respons['0']->trends;
        $all_query = [];

        for ($i = 0; $i <= 9; $i++) {
            if(isset($respons[$i])){
                $result = $respons[$i]->query;
                $result = Twitter::getSearch(['q'=>$result, 'count' => 5, "tweet_mode" => "extended",'result_type=>"popular' ]);
                $all_query[] = $result->statuses;
            }

        }
    }

    public function get_country(){ //-----------------------------------------------getting all county name and woeid

        $respon = Twitter::getTrendsAvailable();
        foreach($respon as $respon=>$val) {
            $country[] = $val->country;
        }
        $country = array_unique($country);
        $country['0'] = "Worldwide";
        return view('layouts.master',["key"=>$country]);

    }
    public function geo(){ //-----------------------------------------------getting all county name and woeid
        $respon = Twitter::getTrendsAvailable();
        dd($respon);
        foreach($respon as $respon=>$val) {
            $country[] = $val->country;
        }
        $country = array_unique($country);
        $country['0'] = "Worldwide";
        return view('layouts.master',["key"=>$country]);

    }
}