<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>@yield('title') | Learnapolis</title>

	<link rel="stylesheet" media="screen" href="{{ URL::asset('css/bootstrap.min.css') }}">
	<link rel="stylesheet" media="screen" href="{{ URL::asset('css/jr.style.css') }}">

	<script src="{{ URL::asset('js/jquery-1.9.1.min.js') }}"></script>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>        
	<![endif]-->
</head>
<body>

@yield('content')

<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

</body>
</html>