@extends('layouts.wish')

@section('content')

    <div class="container" ng-controller="micStreamAngController" ng-init="initCalibrate()">
        <div class="inner-container">
            <div class="calibration">

                <form id="logout-form" action="{{ url('/logout') }}" method="POST">
                    {{ csrf_field() }}
                    <button type="submit">Logout</button>
                </form>

                <div class="calibration-inner">
                    <div class="preset-container">
                        @if(isset($currCookie[1]))
                            <h1 class="preset-curr">Naam: {{ $currCookie[0] }} - Niveau: {{ $currCookie[1] }}</h1>
                        @else
                            <h1 class="preset-curr">No preset selected</h1>
                        @endif
                        @if(isset($presets))
                            @foreach($presets as $preset)
                                <div class="preset-container-inner">
                                    <span>{{$preset->name}}</span>
                                    <span>{{$preset->max}}</span>
                                    <form method="POST" action="./choosepreset">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="preset_name" value="{{$preset->name}}"/>
                                        <input type="hidden" name="preset_max" value="{{$preset->max}}"/>
                                        <button type="submit" name="submit" value="Choose"><i class="fa fa-check-square-o" aria-hidden="true"></i></button>
                                    </form>
                                    <form method="POST" action="./deletepreset">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="delete_id" value="{{$preset->id}}"/>
                                        <button type="submit" name="submit" value="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </form>  
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="preset-new">
                        <form method="POST" action="./savepreset">
                            {{ csrf_field() }}
                            <input class="custom-box" type="text" id="preset_name" name="preset_name" placeholder="Preset naam" required autofocus/>
                            <input class="custom-box" type="number" id="preset_number" name="preset_number" placeholder="Niveau" required/>
                            <button class="button-3d" type="submit" name="submit">Sla preset op</button>
                        </form>
                    </div>
                    <div class="preset-calibrate">
                        <button class="button-3d" ng-click="calibration()">Calibreer microfoon</button>

                        <h1 id="calCounter"></h1>
                    </div>
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
        </div>
    </div>
@endsection
