@extends("layouts.master")
<html>
<head>

</head>

<body>
@section("cont")
    <div class="row">
        @foreach($key as $response=>$group)
            <div class="divider">{{$response}}</div>
            @foreach($group as $id=>$val)
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
        @endforeach
    </div>


</body>

<script>$(document).ready(function () {
        const tilt = $('.js-tilt').tilt({
            glare: true,
            maxGlare: .5,
            scale: 1.0005
        });
    })</script>
@endsection





