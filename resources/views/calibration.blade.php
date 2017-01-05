@extends('layouts.layout')

@section('content')
    <style>
.landerditmoetjijverwijderen {
    background-color: grey;
}
    .preset_ul li{
        display:inline-block;
    }

    </style>
    <div class="landerditmoetjijverwijderen" ng-controller="micStreamAngController" ng-init="initCalibrate()">
       <div>
           <a href="{{ url('/logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
               Logout
           </a>
           <form id="logout-form" action="{{ url('/logout') }}" method="POST">
               {{ csrf_field() }}
           </form>
           @if(isset($currCookie[1]))
           <h1 >  {{ $currCookie[1] }}</h1>
           @else
               <h1>No preset selected</h1>
           @endif
        @if(isset($presets))
            @foreach($presets as $preset)
                <div>

                    <ul class="preset_ul">

                    <li>{{$preset->name}}</li>
                    <li>{{$preset->max}}</li>
                        <li>
                    <form method="POST" action="./choosepreset">
                    {{ csrf_field() }}
                    <input type="hidden" name="preset_name" value="{{$preset->name}}"/>
                    <input type="hidden" name="preset_max" value="{{$preset->max}}"/>
                    <input type="submit" name="submit" value="Choose"/>
                    </form>
                        </li>
                        <li>
                    <form method="POST" action="./deletepreset">
                        {{ csrf_field() }}
                        <input type="hidden" name="delete_id" value="{{$preset->id}}"/>
                        <input type="submit" name="submit" value="Delete"/>
                    </form>
                        </li>
                    </ul>
                </div>

            @endforeach
        @endif

       </div>
       <form method="POST" action="./savepreset">
           {{ csrf_field() }}
           <input type="text" id="preset_name" name="preset_name" placeholder="preset name" required/>
           <input type="number" id="preset_number" name="preset_number" required/>
           <input type="submit" name="submit"/>
       </form>

        <button ng-click="calibration()">Calibrate mic device</button>

        <h1 style="color:white" id="calCounter"></h1>
    </div>
@endsection

@section('scripts')
   {{-- <script src="{{url('/js/calibrate.js')}}"></script>--}}
@endsection