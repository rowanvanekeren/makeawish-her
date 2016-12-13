<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Make a Wish</title>
    <link rel="stylesheet" type="text/css" href="{{url('/css/app.css')}}">
    <script src="{{url('/js/jquery-3.1.1.min.js')}}"></script>
    {{--    <script src="{{url('/js/test2.js')}}"></script>
        <script src="{{url('/js/phaser.min.js')}}"></script>
        <script src="{{url('/js/test.js')}}"></script>--}}

</head>
<body>
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
</body>
</html>