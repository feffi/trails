<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>trails...</title>
		<style>
			@import url(https://fonts.googleapis.com/css?family=Lato:300,400,700);
			@import url(https://fonts.googleapis.com/css?family=The+Girl+Next+Door|PT+Mono|Covered+By+Your+Grace);
		</style>
		{{ HTML::style('packages/twitter/bootstrap/css/bootstrap.min.css') }}
		{{ HTML::style('packages/twitter/bootstrap/css/bootstrap-theme.min.css') }}
		{{ HTML::style('css/main.css') }}
	</head>
	<body>
		<div class="container text-center">
			<button class="btn btn-link btn-lg logo" data-toggle="modal" data-target="#loginDialog">trails...</button>
		</div>
		<div id="loginDialog" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Welcome to <span class="brand h3">trails...</span></h4>
				</div>
				{{ Form::open(array('url' => 'login', 'class' => 'form')) }}
				<div class="modal-body">
						<div class="form-group col-xs-6">
								{{ Form::text('email', Input::old('email'), array('placeholder' => 'your@email.com', 'class' => 'form-control', 'type' => 'email', 'id' => 'email')) }}
						</div>
						<div class="form-group col-xs-6">
								{{ Form::password('password', array('placeholder' => 'your password', 'class' => 'form-control', 'type' => 'password', 'id' => 'password')) }}
				   		</div>
						<p>{{ $errors->first('email') }} {{ $errors->first('password') }}</p>

				</div>
				<div class="modal-footer">
					<div class="form-group">
							<button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-log-in" style="padding-right:10px;"></span>Login</button>
				   	</div>
				</div>
				{{ Form::close() }}
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	</body>
	{{ HTML::script('packages/components/jquery/jquery.js') }}
	{{ HTML::script('packages/twitter/bootstrap/js/bootstrap.min.js') }}
</html>