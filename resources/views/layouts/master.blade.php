<?php
session_start();
use Illuminate\Support\Facades\Input;
$respon = Twitter::getTrendsAvailable();

foreach ($respon as $respon => $val) {
    if (($val->parentid) == 1) {
        $country[$val->woeid] = $val->name;
    }
}

// $country = array_unique($country);

$country[1] = "Worldwide";
$country[23424851] = "Iran";

$oldinput = $old_input;
$lastID = $selected_woeid;
?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    {{Html::style('/css/dd.css')}}
    {{Html::style('/css/flags.css')}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.bootstrap3.css">
    {{Html::style('/css/style.css')}}


    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.min.js"></script>
    {{Html::script('/js/jquery.dd.min.js')}}

    <style>


        @yield("content_css")
    </style>

</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">WebSiteName</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="active"><a href="{{ url('home') }}">Home</a></li>
                <li>
                    {!! Form::open(['method'=>'GET','route'=>['changehome']]) !!}
                    {{ Form::select('size', $country, $lastID,['id' => 'some-id','onchange' => '$("#country_name").val($("#some-id option:selected").text());this.form.submit()']) }}
                    {{ Form::hidden('text',$oldinput,['id' => 'country_name']) }}
                    {!! Form::close() !!}
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="pull-right">
                    {!! Form::open(['method'=>'post','route' => ['trensbyhashtag'],'class'=>'navbar-form navbar-left']) !!}
                    <div class="input-group">
                        {{ Form::text('hashtag','',array('class'=>'form-control','placeholder'=>'Search')) }}
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"> <span class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </li>
            </ul>
        </div>
    </div>
</nav>





{{--//-------------------------------sidebar section--}}
<div class="container-fluid">
    {{--<div class="row">--}}
        {{--<div class="col-sm-3">--}}
        {{--<div class="nav-side-menu">--}}
        {{--<div class="brand">Brand Logo</div>--}}
        {{--<i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>--}}

        {{--<div class="menu-list">--}}

        {{--<ul id="menu-content" class="menu-content collapse out">--}}
        {{--<li>--}}
        {{--<a href="#">--}}
        {{--<i class="fa fa-dashboard fa-lg"></i> Dashboard--}}
        {{--</a>--}}
        {{--</li>--}}

        {{--<li  data-toggle="collapse" data-target="#products" class="collapsed active">--}}
        {{--<a href="#"><i class="fa fa-gift fa-lg"></i> UI Elements <span class="arrow"></span></a>--}}
        {{--</li>--}}
        {{--<ul class="sub-menu collapse" id="products">--}}
        {{--<li class="active"><a href="#">CSS3 Animation</a></li>--}}
        {{--<li><a href="#">General</a></li>--}}
        {{--<li><a href="#">Buttons</a></li>--}}
        {{--<li><a href="#">Tabs & Accordions</a></li>--}}
        {{--<li><a href="#">Typography</a></li>--}}
        {{--<li><a href="#">FontAwesome</a></li>--}}
        {{--<li><a href="#">Slider</a></li>--}}
        {{--<li><a href="#">Panels</a></li>--}}
        {{--<li><a href="#">Widgets</a></li>--}}
        {{--<li><a href="#">Bootstrap Model</a></li>--}}
        {{--</ul>--}}

        {{--<li>--}}
        {{--<a href="#">--}}
        {{--<i class="fa fa-user fa-lg"></i> Profile--}}
        {{--</a>--}}
        {{--</li>--}}

        {{--<li>--}}
        {{--<a href="#">--}}
        {{--<i class="fa fa-users fa-lg"></i> Users--}}
        {{--</a>--}}
        {{--</li>--}}
        {{--</ul>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{--//------------------------------------------end of sidebar--}}

        {{--Main content--}}

            @yield("cont")

    {{--</div>--}}
</div>




<script>
    function openLeftMenu() {
        document.getElementById("leftMenu").style.display = "block";
    }
    function closeLeftMenu() {
        document.getElementById("leftMenu").style.display = "none";
    }

    function openRightMenu() {
        document.getElementById("rightMenu").style.display = "block";
    }
    function closeRightMenu() {
        document.getElementById("rightMenu").style.display = "none";
    }

    $(document).ready(function () {
        $('#select-country').msDropdown();
    })
</script>




</body>
</html>


