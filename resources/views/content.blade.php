@extends("layouts.master")
<html>
<head>
    <style>
        @section("content_css")
    html {
            font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;
            font-size: 14px;
        }

        h5 {
            font-size: 1.28571429em;
            font-weight: 700;
            line-height: 1.2857em;
            margin: 0;
        }

        .card {
            font-size: 1em;
            overflow: hidden;
            padding: 0;
            border: none;
            border-radius: .28571429rem;
            -box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
            display: inline-block;
            width:100%;
            transform: translateZ(20px);
            margin-bottom: 10px;
        }

        .card-holder{
            background-image: linear-gradient(135deg, #b118ac 0%, #26c7da 100%);
            padding: 5px 10px;
            transform-style: preserve-3d;
            margin: 15px 0;
            vertical-align: top;
        }

        .card-block {
            font-size: 1em;
            position: relative;
            margin: 0;
            padding: 1em;
            border: none;
            border-top: 1px solid rgba(34, 36, 38, .1);
            box-shadow: none;
        }


        .card-image-post{
            max-width: 100%;
        }

        .card-img-top {
            /*float: left;*/
            display: inline-block;
            width: 25%;
            margin:20px;
            height: auto;
        }
        .card-title .username{
            text-align: center;
            display: inline-block;
            width: calc( 65% - 40px );
            margin-left: 3%;
            font-size: 40px;
            /*float: left;*/
        }

        .card-title {
            font-size: 1.28571429em;
            font-weight: 700;
            line-height: 1.2857em;
        }

        .card-text {
            clear: both;
            margin-top: .5em;
            color: rgba(0, 0, 0, .68);
        }

        .card-footer {
            font-size: 1em;
            position: static;
            top: 0;
            left: 0;
            max-width: 100%;
            padding: .75em 1em;
            color: rgba(0, 0, 0, .4);
            border-top: 1px solid rgba(0, 0, 0, .05) !important;
            background: #fff;
        }

        .card-inverse .btn {
            border: 1px solid rgba(0, 0, 0, .05);
        }

        .profile {
            position: absolute;
            top: -12px;
            display: inline-block;
            overflow: hidden;
            box-sizing: border-box;
            width: 25px;
            height: 25px;
            margin: 0;
            border: 1px solid #fff;
            border-radius: 50%;
        }

        .profile-avatar {
            display: block;
            width: 100%;
            height: auto;
            border-radius: 50%;
        }

        .profile-inline {
            position: relative;
            top: 0;
            display: inline-block;
        }

        .profile-inline ~ .card-title {
            display: inline-block;
            margin-left: 4px;
            vertical-align: top;
        }

        .text-bold {
            font-weight: 700;
        }

        .meta {
            font-size: 1em;
            color: rgba(0, 0, 0, .4);
        }

        .meta a {
            text-decoration: none;
            color: rgba(0, 0, 0, .4);
        }

        .meta a:hover {
            color: rgba(0, 0, 0, .87);
        }
        @endsection
    </style>

</head>



<body>
@section("cont")
    <div class="row">
        @foreach($key as $response=>$val)
            <div class="col-sm-12 col-md-6" style="vertical-align: top;float: right">
                <div class="card-holder js-tilt" >
                    <div class="card">
                        <div class="card-title">
                            <img class="img-circle card-img-top" src="<?php echo($val['img_url']); ?>">
                            <div class="username">{{'@'}}{{$val['user_name']}}</div>
                        </div>
                        <div class="card-block">
                            @if($val['tweet_img']!="null")
                                <img class="card-image-post" src="<?php echo($val['tweet_img']); ?>">
                            @endif
                            <h4 class="card-title">Tawshif Ahsan Khan</h4>
                            <div class="card-text">
                                {{$val['full_text']}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


</body>

<script>$(document).ready(function () {
        fartscroll();
        const tilt = $('.js-tilt').tilt({
            glare: true,
            maxGlare: .5,
            scale: 1.0005
        });
    })</script>
@endsection




