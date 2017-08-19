@extends('layouts.wish')

@section('content')

    <div class="container-fluid" ng-controller="micStreamAngController" ng-init="initCalibrate()">

        <div class="col-md-6 col-md-offset-3">
            <div class="col-md-12 top-bar">
            <a class="btn-theme-1" href="./">Home</a>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST">
            {{ csrf_field() }}
            <button class="btn-theme-1" type="submit">Logout</button>
        </form>
                </div>
        </div>

        <div class="col-md-6 col-md-offset-3 preset-container">
            @if(isset($currCookie[1]))
                <div class="col-md-12 preset-title">
                <h1 class="preset-curr">Naam: {{ $currCookie[0] }} - Niveau: {{ $currCookie[1] }}</h1>
                </div>
            @else
                <div class="col-md-12 preset-title">
                <h1 class="preset-curr">No preset selected</h1>
                </div>
            @endif
            @if(isset($presets))
                @foreach($presets as $preset)
                    <div class="col-md-12 preset-container-inner">
                        <span>{{$preset->name}}</span>
                        <span>{{$preset->max}}</span>
                        <div class="choose-preset">


                        <form method="POST" action="./choosepreset">
                            {{ csrf_field() }}
                            <input type="hidden" name="preset_name" value="{{$preset->name}}"/>
                            <input type="hidden" name="preset_max" value="{{$preset->max}}"/>
                            <button type="submit" name="submit" value="Choose"><i class="fa fa-check-square-o"
                                                                                  aria-hidden="true"></i></button>
                        </form>
                        <form method="POST" action="./deletepreset">
                            {{ csrf_field() }}
                            <input type="hidden" name="delete_id" value="{{$preset->id}}"/>
                            <button type="submit" name="submit" value="Delete"><i class="fa fa-trash-o"
                                                                                  aria-hidden="true"></i></button>
                        </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="col-md-6 col-md-offset-3 preset-new">
            <div class="col-md-12 inputs-new-preset">
            <form method="POST" action="./savepreset">
                {{ csrf_field() }}
                <input class="custom-box" type="text" id="preset_name" name="preset_name" placeholder="Preset naam"
                       required autofocus/>
                <input class="custom-box" type="number" id="preset_number" name="preset_number" placeholder="Niveau"
                       required/>
                <button class="btn-theme-1" type="submit" name="submit">Sla preset op</button>
            </form>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-3 ">
            <div class="col-md-12 preset-calibrate">
            <button class="btn-theme-1" ng-click="calibration()">Calibreer microfoon</button>

            <h1 id="calCounter"></h1>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-3 preset-calibrate">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>



    </div>
@endsection
