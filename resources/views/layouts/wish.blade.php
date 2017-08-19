<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Blow a Wish') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/jquery-ui.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body id="wish-body" ng-app="blowawish">

	<div class="main-wrapper" style="  ">
	@yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{url('public/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{url('public/js/jquery-ui.js')}}"></script>
    <script src="{{url('public/js/jquery.ui.touch-punch.min.js')}}"></script>
    <script src="{{url('public/js/particles.min.js')}}"></script>

   {{-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>--}}
    <script src="{{url('public/js/html2canvas.js')}}"></script>
	<script src="{{url('public/js/angular.min.js')}}"></script>
	<script src="{{url('public/js/wish_angular.js')}}"></script>

		@yield('scripts')
    <script src="{{ asset('public/js/app.js') }}"></script>
</body>
</html>
