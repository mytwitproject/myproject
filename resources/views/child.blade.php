@extends('master')
        <!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body style="height:1500px">

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Page 1</a></li>
            <li><a href="#">Page 2</a></li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 3 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Page 3-1</a></li>
                    <li><a href="#">Page 3-2</a></li>
                    <li><a href="#">Page 3-3</a></li>
                </ul>
            </li>
        </ul>
        <?php
            $hashta="#حججی";
            ?>
        <div >
            {!! Form::open(['method'=>'post','route' => ['trensbyhashtag'],'class'=>'navbar-form navbar-left']) !!}
                <div class="input-group">
                    {{ Form::text('hashtag','',array('class'=>'form-control','placeholder'=>'Search')) }}

                    <div class="input-group-btn">
                        {{ Form::submit('',['class'=>"btn btn-default"]) }}

                            <i class="glyphicon glyphicon-search"></i>

                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</nav>

<div>
    @yield('sidebar')
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
</script>




</body>
</html>


