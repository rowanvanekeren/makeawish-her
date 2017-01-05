@extends('layouts.layout')

@section('content')
<?php
$general_errors = new \App\Http\Helpers\General_Errors();
$preset_error = $general_errors->general_errors('cookiePreset');
?>
<div ng-controller="wishAngController">

    <form ng-submit="submitWish()">
        <input id="name" type="text" name="name" ng-model="wishFormName" placeholder="naam" required>
        <input id="wish" type="text" name="wish" ng-model="wishFormWish" placeholder="wens" required>
        <input id="submit" type="submit" name="submit" value="Doe een wens">
    </form>

    <form action="./pusher" method="post">
        {{ csrf_field() }}
        <input type="submit">
    </form>
</div>
<div class="blowdiv"></div>
    <div  ng-controller="micStreamAngController" ng-init="initWish()">
        <div ng-show="cookieError">
            <div class="error">{{$preset_error}}</div>
            <a href="./calibration">Choose preset</a>
        </div>
</div>
@endsection