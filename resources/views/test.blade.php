<?php


foreach($key as $response=>$val){
    if(($val->retweet_count)>0){
        $string = $val->retweeted_status->text;
        }
        else
            $string = $val->text;
//if (preg_match('/^[^:]*:/g', $string, $display) === 1) {
  //  echo $display[1];
   // print_r($display);
//}
$result = preg_replace("/RT/", " ", $string);
$result = explode('http', $result);
    echo  $result[0];
    // echo  $string;
            ?>
<br>
<br>
<?php

}


dd($key);
?>