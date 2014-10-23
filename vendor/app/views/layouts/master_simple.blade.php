<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>{{{$title}}}</title>
	<meta name="viewport" content="width=device-width, initial-scale = 1">
	{{ HTML::style('assets/css/style.css')}}
	<script src="http://code.jquery.com/jquery-2.1.1.js"></script>
	<script src="http://code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	<script>
		$(document).ready(function () {
			var url = $(location).attr('href');
		    var segment = url.split('/').pop();
		    $('#tabs ul li a').click(function (e) {
		        location.href = '/'+this.rel;
		    });
		    if (segment == 'decode'){
		    	$('#tabs').tabs({active: 1});
		    } else if (segment == 'symbolic') {
		    	$('#tabs').tabs({active: 2});
		    } else {
		    	$('#tabs').tabs();
		    }
		});
	</script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
	@yield('javascript')
</head>
<body>
	<div id="tabs">
		<ul class="ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all" role="tablist">
	        <li class="ui-state-default ui-corner-top" role="tab" aria-labelledby="ui-id-1" aria-selected="true">
	        	<a href="#tabs-1" class="ui-tabs-anchor" tabindex="0" id="ui-id-1" rel="call-permission">Octal</a></li>
	        <li class="ui-state-default ui-corner-top" role="tab" aria-labelledby="ui-id-2" aria-selected="false">
	        	<a href="#tabs-2" class="ui-tabs-anchor" tabindex="1" id="ui-id-2" rel='call-permission/decode'>Decode</a></li>
	        <li class="ui-state-default ui-corner-top" role="tab" aria-labelledby="ui-id-3" aria-selected="false">
	        	<a href="#tabs-3" class="ui-tabs-anchor" tabindex="2" id="ui-id-3" rel="call-permission/symbolic">Symbolic</a></li>
	        <li style="float:right" class="ui-state-default ui-corner-top" role="tab" aria-controls="tabs-4" aria-labelledby="ui-id-4" aria-selected="false">
	        	<a href="#tabs-4" class="ui-tabs-anchor" tabindex="3" id="ui-id-4" rel="">Home</a></li>
    	</ul>
		@yield('content')
	</div>
</body>
</html>