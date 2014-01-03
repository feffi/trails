<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>login...</title>
		<style>
			@import url(//fonts.googleapis.com/css?family=Lato:300,400,700);
			@import url(//fonts.googleapis.com/css?family=The+Girl+Next+Door|PT+Mono|Covered+By+Your+Grace);
		</style>
		{{ HTML::style('packages/twitter/bootstrap/css/bootstrap.min.css') }}
		{{ HTML::style('packages/twitter/bootstrap/css/bootstrap-theme.min.css') }}
		{{ HTML::style('css/main.css') }}
	</head>
	<body>
		{{ Form::open(array('url' => 'login', 'class' => 'loginForm form-inline')) }}
			<h1>Login...</h1>
			<div class="form-group">
				{{ Form::text('email', Input::old('email'), array('placeholder' => 'your@email.com', 'class' => 'form-control')) }}
			</div>
			<div class="form-group">
				{{ Form::password('password', array('placeholder' => 'password', 'class' => 'form-control')) }}
	   		</div>
			<div class="form-group">
				<button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-log-in"></span></button>
	   		</div>
			<p>{{ $errors->first('email') }} {{ $errors->first('password') }}</p>
		{{ Form::close() }}
	</body>
	{{ HTML::script('packages/components/jquery/jquery.js') }}
	{{ HTML::script('packages/twitter/bootstrap/js/bootstrap.min.js') }}
</html>