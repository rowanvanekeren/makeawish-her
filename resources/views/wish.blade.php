@extends('layouts.layout')

@section('content')
<?php
$general_errors = new \App\Http\Helpers\General_Errors();
$preset_error = $general_errors->general_errors('cookiePreset');
?>
<div ng-controller="wishAngController">
    <div>


    <form class="wish-enter" ng-submit="submitWish()" ng-hide="closeWishEnter">
        <input id="name" type="text" name="name" ng-model="wishFormName" placeholder="naam" required>
        <input id="wish" type="text" name="wish" ng-model="wishFormWish" placeholder="wens" required>
        <input id="submit" type="submit" name="submit" value="Doe een wens">
    </form>
    </div >
    <div class="wish-confirm" ng-show="openWishConfirm">
        <div>
            <h2>@{{ wishName }}</h2>
            <p>@{{ wishText }} </p>
            <button class="button-3d" ng-click="enableBlow()">Blow Wish! </button>
        </div>
    </div>
{{--    <form action="./pusher" method="post">
        {{ csrf_field() }}
        <input type="submit">
    </form>--}}

</div>


    <div  ng-controller="micStreamAngController" ng-init="initWish()">
        <div class="blowdiv" ng-show="blowingEnabled"></div>
    <div class="wish-end" ng-show="wishSend">
    <h1 style="color:white;"> “Those who dream by day are cognizant of many things which escape those who dream only by night.”
        ? Edgar Allan Poe, Eleonora </h1>

    </div >
        <div ng-show="cookieError">
            <div class="error">{{$preset_error}}</div>
            <a href="./calibration">Choose preset</a>
     </div>
</div>
@endsection