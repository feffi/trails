@extends('layouts.base')

@section('title')
	<title>feffi's bookings</title>
@stop

@section('body')
{{ HTML::ul($errors->all()) }}
{{ Form::open(array('url' => 'booking')) }}
	<div class="form-group">
		{{ Form::label('user_id', 'user_id') }}
		{{ Form::text('user_id', Input::old('user_id'), array('class' => 'form-control')) }}
	</div>
	<div class="form-group">
		{{ Form::label('track_id', 'track_id') }}
		{{ Form::text('track_id', Input::old('track_id'), array('class' => 'form-control')) }}
	</div>
	{{ Form::submit('create', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}
@stop
