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
class MainController extends Controller
{

    public function web_trends_byhashtag(Request $request)
    {
        $hashtag = $request->hashtag;
        $request->flash();
        $country_name = $request->session()->get('key');
        $request->session()->put('text_search', $request->hashtag);
        $info = $country_name . "-" . $hashtag . "-" . $request->session()->get('selected_woeid');
        return $this->trends_byhashtag($info);
    }


    public function trends_byhashtag($input){
        $temp = explode('-',$input);
        $country_name = $temp[0];
        $hashtag = $temp[1];
        $selected_woeid = $temp[2];
        try {
            if ($country_name == "Worldwide") {
                $response = Twitter::getSearch(['q' => $hashtag, 'count' => 15, "tweet_mode" => "extended",]);
                $response = $response->statuses;
            } else {
                $respon = Twitter::getGeoSearch(['query' => $country_name]);
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
                //---------------------------------------------------
                $response = Twitter::getSearch(['q' => $hashtag, 'count' => 15, "tweet_mode" => "extended", 'geocode' => $lat . "," . $long . "," .$distance, 'result_type=>"popular']);
                $response = $response->statuses;
            }


            $all = [];

            foreach ($response as $response => $val) {
                $tweet_image = isset($val->entities->media) ? $val->entities->media[0]->media_url : null;
                $temp = isset($val->retweeted_status) ? $val->retweeted_status->full_text : $val->full_text;
                $temp = preg_replace("/RT /", " ", $temp);
                $temp = preg_replace("/(@.*? )/", " ", $temp);
                $temp = explode('http', $temp);
                $full = ['full_text' => $temp[0],
                    'user_name' => $val->user->screen_name,
                    'img_url' => $val->user->profile_image_url,
                    'tweet_img' => $tweet_image,
                    'created_at' => $val->created_at
                ];
                $all[] = $full;
            }

            return view('content', [
                "key" => $all,
                "selected_woeid" => $selected_woeid,
                'old_input' => $hashtag
            ]);

        } catch (Exception $e) {
            // dd(Twitter::error());
            // echo json_encode($response);
            dd(Twitter::logs());
        }
    }

    public function Most_recent(Request $request)
    {//----------------------------------------------------------getting 10 top trend
        $request->session()->put('key','Worldwide');
        $request->session()->put('text_search','');
        $request->session()->put('selected_woeid',1);

        $respons = Twitter::getTrendsPlace(["id" => 1]);
        $respons = $respons['0']->trends;
        $all_query = [];
        for ($i = 0; $i <= 9; $i++) {
            $all = [];
            if (isset($respons[$i])) {
                $result = $respons[$i]->query;
                $result = Twitter::getSearch(['q' => $result, 'count' => 5, "tweet_mode" => "extended", 'result_type' => 'popular']);
                $result = $result->statuses;
                foreach ($result as $k => $val) {
                    $tweet_image = isset($val->entities->media) ? $val->entities->media[0]->media_url : null;
                    $temp = isset($val->retweeted_status) ? $val->retweeted_status->full_text : $val->full_text;
                    $temp = preg_replace("/RT /", " ", $temp);
                    $temp = preg_replace("/(@.*? )/", " ", $temp);
                    $temp = explode('http', $temp);
                    $full = [
                        'full_text' => $temp[0],
                        'user_name' => $val->user->screen_name,
                        'img_url' => $val->user->profile_image_url,
                        'tweet_img' => $tweet_image,
                        'created_at' => $val->created_at
                    ];
                    $all[] = $full;
                }
                $all_query[$respons[$i]->name] = $all;
            }
        }
        return view('home', [
            'k' => $all_query,
            'selected_woeid' => 1,
            'old_input' => ''
        ]);
    }

    //-----------------------------------------------------------------
    public function get_country()
    {
        return view('layouts.master');
    }

    //----------------------------------------------------------getting 10 top trend
    public function Most_recent_country(Request $request)
    {
        $oldinput = $request->old('hashtag');
        $request->session()->put('key', $request->input('text'));
        $request->session()->put('selected_woeid',$_GET['size']);

        if ($request->session()->get('text_search') == '') {
            $respons = Twitter::getTrendsPlace(["id" => $_GET['size']]);
            $respons = $respons['0']->trends;
            $all_query = [];
            for ($i = 0; $i <= 9; $i++) {
                $all = [];
                if (isset($respons[$i])) {
                    $result = $respons[$i]->query;
                    $result = Twitter::getSearch(['q' => $result, 'count' => 5, "tweet_mode" => "extended", 'result_type' => 'popular']);
                    $result = $result->statuses;
                    foreach ($result as $k => $val) {
                        $tweet_image = isset($val->entities->media) ? $val->entities->media[0]->media_url : null;
                        $temp = isset($val->retweeted_status) ? $val->retweeted_status->full_text : $val->full_text;
                        $temp = preg_replace("/RT /", " ", $temp);
                        $temp = preg_replace("/(@.*? )/", " ", $temp);
                        $temp = explode('http', $temp);
                        $full = ['full_text' => $temp[0],
                            'user_name' => $val->user->screen_name,
                            'img_url' => $val->user->profile_image_url,
                            'tweet_img' => $tweet_image,
                            'created_at' => $val->created_at
                        ];
                        $all[] = $full;
                    }
                    $all_query[$respons[$i]->name] = $all;
                }
            }
            return view('home', [
                'k' => $all_query,
                'selected_woeid' => $request->session()->get('selected_woeid'),
                'old_input' => $oldinput
            ]);
        } else {
            $info = $request->session()->get('key') . "-" . $request->session()->get('text_search') . "-" . $request->session()->get('selected_woeid');
            return $this->trends_byhashtag($info);
        }
    }

}