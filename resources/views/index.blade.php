<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Blow a Wish') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{asset('public/css/app.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body ng-app="blowawish">

<div class="container-fluid">
    <div class="row home-img-wrapper" style="background-image: url({{asset('public/images/background/dream.jpg')}});">
        <div class="col-md-12">  <img class="insta-logo" src="{{ asset('/public/images/icons/logo-text.png') }}"> </div>

        <h1>Deel jouw droom, wens of inspiratievolle tekst met de wereld</h1>
        <a href="./wish">Deel je droom!</a>
    </div>

    <div class="row steps" ng-hide="stepSection">
        <div class="col-md-6 col-md-offset-3 step-wrapper home-steps">
            <div class="step-section">
                <div class="step-number">1</div>
                <div class="step-title">Kies foto</div>
            </div>

            <div class="step-section">
                <div class="step-number">2</div>
                <div class="step-title">Bewerk foto</div>
            </div>
            <div class="step-section">
                <div class="step-number">3</div>
                <div class="step-title">Verzend!</div>
            </div>
        </div>
    </div>
    <div class="row index-images-title">
        <h2> Laatste Wensen </h2>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="index-images-wrapper">
                <style>

                </style>
                @if(isset($wishes))
                    @foreach($wishes as $wish)
                        {{--   <div class="col-md-4 index-image">
                           <img class="overview-img" src="{{ asset('public/images/insta/' . $wish->image) }}" />
                           </div>--}}

                        <div class="block">
                            <img class="overview-img" src="{{ asset('public/images/insta/' . $wish->image) }}"/>
                        </div>

                    @endforeach
                @endif
            </div>
        </div>

    </div>
</div>


<!-- Scripts -->
<script src="{{url('public/js/jquery-3.1.1.min.js')}}"></script>
@yield('scripts')
<script src="{{asset('public/js/app.js')}}"></script>
<script src="{{url('public/js/masonry.pkgd.min.js')}}"></script>
<script src="{{url('public/js/imagesloaded.pkgd.min.js')}}"></script>

<script src="{{url('public/js/home.js')}}"></script>
</body>
</html>
