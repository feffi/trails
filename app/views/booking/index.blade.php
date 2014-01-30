@extends('layouts.base')

@section('title')
	<title>feffi's bookings</title>
@stop @section('body')

@if (Session::has('message'))
	<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td>id</td>
			<td>user_id</td>
			<td>track_id</td>
			<td>Actions</td>
		</tr>
	</thead>
	<tbody>
		@foreach($bookings as $key => $value)
		<tr>
			<td>{{ $value->id }}</td>
			<td>{{ $value->user_id }}</td>
			<td>{{ $value->track_id }}</td>
			<td>
				<a class="btn btn-small btn-success" href="{{ URL::to('booking/'.$value->id) }}">details</a>
				<a class="btn btn-small btn-info" href="{{ URL::to('booking/'.$value->id.'/edit') }}">edit</a>
				{{ Form::open(array('url' => 'booking/'.$value->id)) }}
					{{ Form::hidden('_method', 'DELETE') }}
					{{ Form::submit('delete', array('class' => 'btn btn-warning')) }}
				{{ Form::close() }}
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@stop
