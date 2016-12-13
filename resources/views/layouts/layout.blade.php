<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Make a Wish</title>
    <link rel="stylesheet" type="text/css" href="{{url('/css/test.css')}}">

    {{--    <script src="{{url('/js/test2.js')}}"></script>
        <script src="{{url('/js/phaser.min.js')}}"></script>
        <script src="{{url('/js/test.js')}}"></script>--}}

</head>
<body ng-app="blowawish">
@yield('content')

<script src="{{url('/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{url('/js/angular.min.js')}}"></script>
<script src="{{url('/js/wish_angular.js')}}"></script>
</body>
</html>