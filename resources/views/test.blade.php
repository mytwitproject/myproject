<?php


foreach($key as $response=>$val){
    $string = $val->text;
if (preg_match('/(RT @)(.*?)/', $string, $display) === 1) {
    //echo $display[1];
    print_r($display);
}

//$result = explode('http', $result);
   // echo  $result[0];
     //echo  $result[1];
            ?>
<br>
<br>
<?php

}


dd($key);
?>