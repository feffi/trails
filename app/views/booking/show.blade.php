@extends('layouts.base')

@section('title')
	<title>feffi's bookings</title>
@stop

@section('body')
<div class="jumbotron text-center">
		<h2>{{ $booking->id }}</h2>
		<p>
			<strong>user_id</strong> {{ $booking->user_id }}<br>
			<strong>track_id</strong> {{ $booking->track_id }}
		</p>
	</div>
@stop