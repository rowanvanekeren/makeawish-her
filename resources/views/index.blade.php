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
    <link href="{{asset('css/app.css')}}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body ng-app="blowawish">
	<nav>
		<img src="{{ asset('images/logo.png') }}" alt="Het logo van InstaWish">
	</nav>

	<div class="container">
		<div class="steps">
			<div class="wishit">
				<img src="{{ asset('images/tekstballon.png') }}" alt="">
				<p>Wish it</p>
			</div>
			<div class="blowit">
				<img src="{{ asset('images/wind.png') }}" alt="">
				<p>Blow it</p>
			</div>
			<div class="instait">
				<img src="{{ asset('images/insta.png') }}" alt="">
				<p>Insta it</p>
			</div>
		</div>

		<div class="button-container">
			<a href="{{ url('/wish') }}">Let's wish!</a>
		</div>
	</div>


    <!-- Scripts -->
    <script src="{{url('/js/jquery-3.1.1.min.js')}}"></script>
	<script src="{{url('/js/angular.min.js')}}"></script>
	<script src="{{url('/js/wish_angular.js')}}"></script>

		@yield('scripts')
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>
