<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Make a Wish</title>
    <link rel="stylesheet" type="text/css" href="{{url('/css/app.css')}}">
</head>
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
					<a href="/wish">Wish</a>
				</li>
			</ul>
		</div>	
	</nav>

	@yield('content')

<script src="{{url('/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{url('/js/angular.min.js')}}"></script>
<script src="{{url('/js/wish_angular.js')}}"></script>
</body>
</html>