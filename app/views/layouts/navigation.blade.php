<nav class="navbar navbar-pills navbar-fixed-top" role="navigation">
	<a class="navbar-brand brand" href="#" style="font-size: 36px;">trails...</a>
	<ul class="nav navbar-nav">
		<li class="active"><a href="{{ URL::secure('dashboard'); }}">Dashboard</a></li>
		<li><a href="{{ URL::secure('conferences'); }}">Conferences<span class="badge btn-success" style="margin-left:5px;">8</span></a></li>
		<li><a href="{{ URL::secure('courses'); }}">Courses<span class="badge btn-success" style="margin-left:5px;">42</span></a></li>
		<li><a href="{{ URL::secure('backlog'); }}">Upcoming<span class="badge btn-success" style="margin-left:5px;">12</span></a></li>
	</ul>
	<ul class="nav navbar-nav navbar-right">
		<li><p class="navbar-text">Signed in as <a href="profile" class="navbar-link"><strong>feffi</strong></a></p></li>
		<li>
			{{ Form::open(array('url' => 'logout', 'class' => 'form')) }}
				<button type="submit" class="btn navbar-btn btn-success" style="padding-right: 50px;"><span class="glyphicon glyphicon-log-out"></span></button>
			{{ Form::close() }}
			</li>
	</ul>
</nav>