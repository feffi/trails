@extends('layouts.base')

@section('title')
	<title>{{ Auth::user()->username }}'s profile</title>
@stop

@section('body')
	<div class="container">
		<div class="row">
			<div class="page-header">
				<h1 class="brand h1">{{ Auth::user()->username }}'s profile</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">Authentication</h3>
					</div>
					<div class="panel-body">
						{{ Form::open(array('url' => 'login', 'class' => 'form-horizontal loginForm', 'role' => 'form')) }}
							<div class="form-group">{{ Form::text('Username', Auth::user()->username, array('placeholder' => 'your username', 'class' => 'form-control')) }}</div>
							<div class="form-group">{{ Form::text('E-Mail', Auth::user()->email, array('placeholder' => 'your@email.com', 'class' => 'form-control')) }}</div>
							<div class="form-group">{{ Form::password('password', array('placeholder' => 'password', 'class' => 'form-control')) }}</div>
							<div class="form-group">
								<button type="submit" class="btn btn-info">
									<span class="glyphicon glyphicon-log-in"></span>
								</button>
							</div>
							<p>{{ $errors->first('username') }} {{ $errors->first('email') }} {{ $errors->first('password') }}</p>
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@stop


@section('body')
	<div class="container">
		<div class="well well-sm">
			<h1>profile...</h1>
			{{ Form::open(array('url' => 'login', 'class' => 'form-horizontal loginForm', 'role' => 'form')) }}
			<div class="form-group">{{ Form::text('Username', Auth::user()->username, array('placeholder' => 'your username', 'class' => 'form-control')) }}</div>
			<div class="form-group">{{ Form::text('E-Mail', Auth::user()->email, array('placeholder' => 'your@email.com', 'class' => 'form-control')) }}</div>
			<div class="form-group">{{ Form::password('password', array('placeholder' => 'password', 'class' => 'form-control')) }}</div>
			<div class="form-group">
				<button type="submit" class="btn btn-info">
					<span class="glyphicon glyphicon-log-in"></span>
				</button>
			</div>
			<p>{{ $errors->first('username') }} {{ $errors->first('email') }} {{ $errors->first('password') }}</p>
			{{ Form::close() }}
		</div>
	</div>
@stop