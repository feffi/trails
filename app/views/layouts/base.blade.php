<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		@section('title')
		<title>Welcome to trails...</title>
		@show
		<style>
			@import url(https://fonts.googleapis.com/css?family=Lato:300,400,700);
			@import url(https://fonts.googleapis.com/css?family=The+Girl+Next+Door|PT+Mono|Covered+By+Your+Grace);
		</style>
		{{ HTML::style('packages/twitter/bootstrap/css/bootstrap.min.css') }}
		{{ HTML::style('packages/twitter/bootstrap/css/bootstrap-theme.min.css') }}
		{{ HTML::style('css/main.css') }}
	</head>
	<body>
		@include('layouts.navigation')
		@yield('body')
		@include('layouts.footer')
	</body>
</html>