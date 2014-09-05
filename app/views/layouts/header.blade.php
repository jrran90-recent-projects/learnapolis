<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>@yield('title') | Learnapolis</title>

	<!-- Stylesheet -->
	<link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}" media="screen">
	<link rel="stylesheet" href="{{ URL::asset('font-awesome/css/font-awesome.css') }}">

	<link rel="stylesheet" href="{{ URL::asset('css/typeahead.css') }}">

	<link rel="stylesheet" href="{{ URL::asset('css/file-upload/jquery.fileupload.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('css/jr.style.css') }}" media="screen">

	<script src="{{ URL::asset('js/jquery-1.9.1.min.js') }}"></script>
</head>

<body class="body-adjust-nav">


<!-- <img src="../img/loader.gif" class="hide customize_loader" style="position:absolute; left:45%; top:50%"> -->


<!-- ============================== Start Header ============================== -->
<nav class="navbar navbar-default navbar-fixed-top lp-navbar" role="navigation">

	<div class="container container-960">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar icon-bar-white"></span>
				<span class="icon-bar icon-bar-white"></span>
				<span class="icon-bar icon-bar-white"></span>
			</button>
			<a class="navbar-brand remove-padding" href="{{ URL::to('user') }}" style="line-height:50px">
				<img src="{{ URL::asset('img/logo.png') }}" alt="learnapolis" style="width:150px">
			</a>
		</div>

		<div class="collapse navbar-collapse">
			<form class="navbar-form navbar-left" role="search">
				<div class="form-group">
					<input type="text" id="mainSearch" class="typeahead form-control" placeholder="Search.." style="width:440px">
				</div>
			</form>

			<ul class="nav navbar-nav navbar-right" id="header-navbar-noti">

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="fa fa-envelope fa-fw fa-lg"></span>
						<span style="position:absolute" class="badge"></span>
					</a>
					<ul class="dropdown-menu"></ul>
				</li>

				<li class="dropdown notification_flyout_parent">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="fa fa-book fa-lg"></span>
						<span style="position:absolute" class="badge"></span>
					</a>
					<!-- <ul id="connectionNotificationResult" class="notification_flyout list-unstyled hide">
						<li class="_notiHeader"><small>Connection Request</small></li>
					</ul> -->
					<ul class="dropdown-menu"></ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="fa fa-bar-chart-o fa-fw fa-lg"></span>
						<span style="position:absolute" class="badge"></span>
					</a>
					<ul class="dropdown-menu"></ul>
				</li>

				<li class="dropdown" id="head_noti">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="fa fa-bell fa-lg"></span>
						<span style="position:absolute" class="badge"></span>
					</a>
					<ul class="dropdown-menu">
						<!-- <li class="dropdown-header">Notification</li> -->
					</ul>
				</li>				

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog fa-lg"></span> Profile <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#">Account Settings</a></li>
						<li><a href="{{ URL::to('logout') }}">Logout</a></li>
						<li class="divider"></li>
						<li><a href="#"><span class="glyphicon glyphicon-phone-alt"></span> Help</a></li>
					</ul>
				</li>
			</ul>		
		</div><!-- /.navbar-collapse -->

	</div>

</nav>