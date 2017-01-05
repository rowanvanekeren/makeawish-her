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
    <link href="/css/app.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <body ng-app="blowawish">
	<nav>
		<div class="inner-nav">
			<ul>
				<li>
					<a href="/home">Home</a>
				</li>
				<li>
					<img src="" alt="Logo Blow-A-Wish">
				</li>
				<li>
					<a href="/overview">Wish</a>
				</li>
			</ul>
		</div>	
	</nav>

		@yield('content')
    
    </div>

    <!-- Scripts -->
    <script src="{{url('/js/jquery-3.1.1.min.js')}}"></script>
	<script src="{{url('/js/angular.min.js')}}"></script>
	<script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

	<script src="{{url('/js/wish_angular.js')}}"></script>
	<script src="{{url('/js/phaser.min.js')}}"></script>
	{{--<script src="{{url('/js/test2.js')}}"></script>--}}
	{{--<script src="{{url('/js/test4.js')}}"></script>--}}
		@yield('scripts')
    <script src="/js/app.js"></script>
</body>
</html>
