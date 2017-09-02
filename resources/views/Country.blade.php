@extends('layouts.master')
@section('cont')
<html>
<head>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/selectize.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.bootstrap3.css">
</head>
<body>
<select id="select-country">
    <option value='1'>iran</option>
    <option value='2'>india</option>
    <option value='3'>iragh</option>
    <option value='4'>ikbiri</option>

</select>
</body>

<script>

    $(document).ready(function(){
        $('#select-country').selectize();
    });
</script>
    @endsection
</html>