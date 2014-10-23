<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>{{{$title}}}</title>
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	@yield('stylesheet')
	@yield('javascript')
</head>
<body>
	<div class="container">
		@yield('content')
	</div>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>