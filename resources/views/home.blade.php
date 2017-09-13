@extends("layouts.master")

@section("cont")
    @foreach($k as $response=>$group)
        <div class="status_divider">{{urldecode($response)}}</div>
        @foreach($group as $id=>$val)
            <div class="row">
                <div class="card">
                    <div class="card-title">
                        <div class="username"> {{'@'.$val['user_name']}} </div>
                        <div class="date"> 2014-02-11 08:50</div>
                    </div>
                    <div class="card-block">
                        <img class="img-circle card-img-top" src="{{str_replace("normal","400x400",$val['img_url'])}}">
                        <div class="card-text">
                            {{$val['full_text']}}
                        </div>
                        @if($val['tweet_img']!="null")
                            <hr>
                            <img class="card-image-post" src="{{$val['tweet_img']}}">
                        @endif
                    </div>
                </div>
            </div>

            {{--<div class="col-sm-12 col-md-6" style="vertical-align: top;">--}}
            {{--<div class="card-holder js-tilt" >--}}
            {{--<div class="card">--}}
            {{--<div class="card-title">--}}
            {{--<img class="img-circle card-img-top" src="{{$val['img_url']}}">--}}
            {{--<div class="username">{{'@'}}{{$val['user_name']}}</div>--}}
            {{--</div>--}}
            {{--<div class="card-block">--}}
            {{--@if($val['tweet_img']!="null")--}}
            {{--<img class="card-image-post" src="{{$val['tweet_img']}}">--}}
            {{--@endif--}}
            {{--<div class="card-text">--}}
            {{--{{$val['full_text']}}--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
            {{--</div>--}}
        @endforeach
    @endforeach

    <script>$(document).ready(function () {
//            const tilt = $('.js-tilt').tilt({
//                scale: 1.0005
//            });
            let colors = ["#E53935", "#D81B60", "#8E24AA", "#5E35B1", "#3949AB", "#1E88E5", "#039BE5", "#00ACC1", "#00897B", "#43A047", "#7CB342", "#C0CA33", "#FDD835", "#FFB300", "#FB8C00", "#F4511E", "#6D4C41", "#757575", "#546E7A"];
            $(".card-title").each(function(_,item){
                $(item).css({
                    "background":"linear-gradient(225deg, "+colors[Math.floor(Math.random()*colors.length)]+", "+colors[Math.floor(Math.random()*colors.length)]+")",
                    "background-size": "400% 400%",
                    "animation": "AnimationName 7s ease infinite"
                });
            });
        })</script>
@endsection




