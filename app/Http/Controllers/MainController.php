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

            $response = Twitter::getSearch(['q'=>$hashtag]);

            $response = $response->statuses;
            //  echo json_encode( $response);
            //echo $response->statuses[1]->text;

            //echo json_encode( $response);
            return view('test',["key"=>$response]);
            // dd($response);
        }
        catch (Exception $e)
        {
            // dd(Twitter::error());
          // echo json_encode($response);
            dd(Twitter::logs());
        }

    }

}