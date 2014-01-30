@extends('layouts.base')

@section('title')
	<title>feffi's bookings</title>
@stop

@section('body')
{{ HTML::ul($errors->all()) }}

{{ Form::model($booking, array('route' => array('booking.update', $booking->id), 'method' => 'PUT')) }}
	<div class="form-group">
		{{ Form::label('user_id', 'user_id') }}
		{{ Form::email('user_id', null, array('class' => 'form-control')) }}
	</div>

	<div class="form-group">
		{{ Form::label('track_id', 'track_id') }}
		{{ Form::email('track_id', null, array('class' => 'form-control')) }}
	</div>

	{{ Form::submit('edit', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}
@stop