@extends('layouts.layout')

@section('content')

    <div class="container" ng-controller="micStreamAngController" ng-init="initCalibrate()">
        <div class="inner-container">
            <div class="custom-style">
                <a href="{{ url('/logout') }}"
                   onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ url('/logout') }}" method="POST">
                    {{ csrf_field() }}
                </form>


                @if(isset($currCookie[1]))
                   <h1 class="preset-curr">{{ $currCookie[0] }} - {{ $currCookie[1] }}</h1>
                @else
                    <h1 class="preset-curr">No preset selected</h1>
                @endif
                <div class="preset-container">
                    <table>
                    @if(isset($presets))
                        @foreach($presets as $preset)



                        <tr>
                                    <td class="preset-name"><div>{{$preset->name}}</div></td>
                                    <td  class="preset-value"><div>{{$preset->max}}</div></td>
                                    <td >
                                        <form method="POST" action="./choosepreset">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="preset_name" value="{{$preset->name}}"/>
                                            <input type="hidden" name="preset_max" value="{{$preset->max}}"/>
                                            <input class="button-3d choose" type="submit" name="submit" value="Choose"/>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="./deletepreset">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="delete_id" value="{{$preset->id}}"/>
                                            <input class="button-3d delete" type="submit" name="submit" value="Delete"/>
                                        </form>
                                    </td>
                        </tr>


                        @endforeach
                    @endif
                    </table>
                </div>
                <div class="preset-new">
                <form method="POST" action="./savepreset">
                    {{ csrf_field() }}
                    <ul>
                    <li><div><input class="custom-box" type="text" id="preset_name" name="preset_name" placeholder="preset name" required/></div></li>
                        <li> <div> <input class="custom-box"type="number" id="preset_number" name="preset_number" required/></div></li>
                        <li> <div> <input class="button-3d" type="submit" name="submit" value="Save Preset"/></div></li>
                    </ul>
                </form>
                </div>
                <div class="preset-calibrate">
                    <button class="button-3d" ng-click="calibration()">Calibrate mic device</button>

                        <h1 id="calCounter"></h1>
                </div>
            </div>
        </div>
    </div>
@endsection
