<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Welcome to trails...</title>
<style>
@import url(https://fonts.googleapis.com/css?family=Lato:300,400,700);
@import url(https://fonts.googleapis.com/css?family=The+Girl+Next+Door|PT+Mono|Covered+By+Your+Grace);
</style>
{{ HTML::style('packages/twitter/bootstrap/css/bootstrap.min.css') }}
{{ HTML::style('packages/twitter/bootstrap/css/bootstrap-theme.min.css') }}
{{ HTML::style('css/main.css') }}
</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<a class="navbar-brand brand" href="#" style="font-size: 36px;">trails...</a>
		<ul class="nav navbar-nav">
			<li class="active"><a href="{{ URL::secure('dashboard'); }}">Dashboard</a></li>
			<li><a href="{{ URL::secure('conferences'); }}">Conferences<span class="badge btn-success" style="margin-left:5px;">8</span></a></li>
			<li><a href="{{ URL::secure('courses'); }}">Courses<span class="badge btn-success" style="margin-left:5px;">42</span></a></li>
			<li><a href="{{ URL::secure('backlog'); }}">Upcoming<span class="badge btn-success" style="margin-left:5px;">12</span></a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li><p class="navbar-text">Signed in as <a href="profile" class="navbar-link"><strong>{{ Auth::user()->username }}</strong></a></p></li>
			<li>
				{{ Form::open(array('url' => 'logout', 'class' => 'form')) }}
					<button type="submit" class="btn navbar-btn btn-success" style="padding-right: 50px;"><span class="glyphicon glyphicon-log-out"></span></button>
				{{ Form::close() }}
				</li>
		</ul>
	</nav>
	<div class="container">
		<div class="row">
			<div class="page-header">
				<h1 class="brand h1">Dashboard</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">My conferences</h3>
					</div>
					<div class="panel-body">
						Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">My courses</h3>
					</div>
					<div class="panel-body">
						Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-success">
					<div class="panel-heading">
						<h3 class="panel-title">Upcoming events</h3>
					</div>
					<div class="panel-body">
						Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
{{ HTML::script('packages/components/jquery/jquery.js') }}
{{ HTML::script('packages/twitter/bootstrap/js/bootstrap.min.js') }}
<script type="text/javascript"><!--
	//$('#welcome').modal('show')
//--></script>
</html>