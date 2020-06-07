<!DOCTYPE html>
<html>
<head>
    @section('title')
    @show
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    @section('metatags')
    @show
    <link rel="icon" sizes="192x192" href="{{ asset('images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/appleicon.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap&subset=cyrillic" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/materialize.min.css?1') }}"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/common.css?112') }}"  media="screen,projection"/>
  
</head>
<body>
<header>
       
@section('header')
@show
</header>
@section('content')
@show
<script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/materialize.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/common.js?791') }}"></script>
@section('footlink')
@show




</body>
</html>
