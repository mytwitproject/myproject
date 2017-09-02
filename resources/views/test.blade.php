@extends('child');
<ul>
<br><br><br><br><br>
@foreach($key as $response=>$val)
             {{$img=$val['full_text']}}

    <img src="<?php echo($val['img_url']); ?>">
        <br><br>

@endforeach

</ul>





{{--<?php--}}
{{--//too blade nemikhad injuri bezani--}}

{{--@foreach($key as $response=>$val){--}}
{{--$val->text--}}
{{--//    if(($val->retweet_count)>0){--}}
{{--//        $string = $val->retweeted_status->text;--}}
{{--//        }--}}
{{--//        else--}}
{{--//            $string = $val->text;--}}
{{--//if (preg_match('/^[^:]*:/g', $string, $display) === 1) {--}}
  {{--//  echo $display[1];--}}
   {{--// print_r($display);--}}
{{--//}--}}
{{--$result = preg_replace("/RT/", " ", $string);--}}
{{--$result = explode('http', $result);--}}
    {{--echo  $result[0];--}}
    {{--// echo  $string;--}}
            {{--?>--}}
{{--<br>--}}
{{--<br>--}}
{{--<?php--}}

{{--}--}}


{{--dd($key);--}}
{{--?>--}}