@extends('layouts.wish')

@section('content')
<?php
$general_errors = new \App\Http\Helpers\general_errors();
$preset_error = $general_errors->general_errors('cookiePreset');
?>
<div ng-controller="wishAngController" class="container">
    <div class="wish-enter" ng-hide="closeWishEnter">
        <form ng-submit="submitWish()"  style="background-image: url({{asset('images/tekstballon-2.png')}})">
            {{ csrf_field() }}
            <input type="text" id="wish" type="text" class="form-control" name="wish" ng-model="wishFormWish" value="{{ old('wish') }}" autofocus placeholder="Type your wish here..." autocomplete="off">
            <input id="name" type="text" class="form-control" name="name" ng-model="wishFormName" value="{{ old('name') }}" placeholder="Naam" autocomplete="off">
            
            @if ($errors->has('wish'))
            <span class="help-block">
                <strong>{{ $errors->first('wish') }}</strong>
            </span>
            @endif

            <button type="submit" class="button-wish" ng-click="enableBlow()">GO</button>
        </form>

        <!-- Als insta post niet meer werkt, deze div terug buiten wish-enter zetten -->
        <div id='insta_image' class="instaWish" style="background-image: url({{asset('images/insta-bg/'. rand(1, 5) . '.jpg')}})">
            <h1>"@{{ wishFormWish }}"</h1>
            <h3>-@{{ wishFormName }}</h3>
        </div>
    </div>

    <!--
    <form class="" ng-submit="submitWish()" ng-hide="closeWishEnter">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Naam</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" ng-model="wishFormName" value="{{ old('name') }}"  required autofocus placeholder="Naam">

                @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="wish" class="col-md-4 control-label">Wens</label>

            <div class="col-md-6">
                <textarea rows="4" id="wish" type="text" class="form-control" name="wish" ng-model="wishFormWish" value="{{ old('wish') }}"  required autofocus placeholder="Wens"></textarea>

                @if ($errors->has('wish'))
                <span class="help-block">
                    <strong>{{ $errors->first('wish') }}</strong>
                </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Doe een wens!
                </button>
            </div>
        </div>
    </form> 

    <div class="wish-confirm" ng-show="openWishConfirm">
        <div class="wish-confirm-inner">
            <h2>@{{ wishText }}</h2>
            <p>- @{{ wishName }} </p>
            <button class="button-3d" ng-click="enableBlow()">Blaas je wens weg! </button>
        </div>
    </div>
    -->

    {{--    
    <form action="./pusher" method="post">
        {{ csrf_field() }}
        <input type="submit">
    </form>
    --}}

    <div class="wish-blow" ng-controller="micStreamAngController" ng-init="initWish()" ng-show="blowingEnabled">
        <img src="/images/upload-2.svg" alt="">
        <div class="blowdiv">
            <div class="blowdiv-inner" style="background-image: url( {{asset('/images/tekstballon-2.png')}} )">
                <h2>@{{ wishText }}</h2>
                <p>- @{{ wishName }} </p>
            </div>
        </div>

        <div class="text">
            <p>Now blow it away!</p>
        </div>

        <!--
        <div class="wish-end" ng-show="wishSend">
            <p>
                <i class="fa fa-quote-left" aria-hidden="true"></i>
                Those who dream by day are cognizant of many things which escape those who dream only by night.
                <i class="fa fa-quote-right" aria-hidden="true"></i>
            </p>
            <span>- Edgar Allan Poe, Eleonora</span>
        </div >
        -->
        <div ng-show="cookieError">
            <div class="error">{{$preset_error}}</div>
            <a href="./calibration">Choose preset</a>
        </div>
    </div>   
</div>
@endsection