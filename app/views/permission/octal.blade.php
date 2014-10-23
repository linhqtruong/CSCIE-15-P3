@extends('layouts.master_simple')

@section('content')
	{{-- expr --}}
	<div id="tabs-1" style="display: block;">
		<h1>Permission Bits</h1>
		<p>Select the permissions you require below. The tool will provide you with an octal code that corresponds to these permissions which can then be applied to relevant directories and files with chmod.</p>
		<div id="perms">
			<fieldset>
				<legend>Special</legend>
				{{Form::label('s_u','setuid')}}
				{{Form::checkbox('special','u','',array('id' => 's_u'))}}
				<br/>
				{{Form::label('s_g','setgid')}}
				{{Form::checkbox('special','g','',array('id' => 's_g'))}}
				<br/>
				{{Form::label('s_o','Sticky bit')}}
				{{Form::checkbox('special','o','',array('id' => 's_o'))}}
			</fieldset>
			<fieldset>
				<legend>User</legend>
				{{Form::label('u_r','Read')}}
				{{Form::checkbox('user','r','',array('id' => 'u_r'))}}
				<br/>
				{{Form::label('u_w','Write')}}
				{{Form::checkbox('user','w','',array('id' => 'u_w'))}}
				<br/>
				{{Form::label('u_x','Execute')}}
				{{Form::checkbox('user','x','',array('id' => 'u_x'))}}
			</fieldset>
			<fieldset>
				<legend>Group</legend>
				{{Form::label('g_r','Read')}}
				{{Form::checkbox('group','r','',array('id' => 'g_r'))}}
				<br/>
				{{Form::label('g_w','Write')}}
				{{Form::checkbox('group','w','',array('id' => 'g_w'))}}
				<br/>
				{{Form::label('g_x','Execute')}}
				{{Form::checkbox('group','x','',array('id' => 'g_x'))}}
			</fieldset>
			<fieldset>
				<legend>Other</legend>
				{{Form::label('o_r','Read')}}
				{{Form::checkbox('other','r','',array('id' => 'o_r'))}}
				<br/>
				{{Form::label('o_w','Write')}}
				{{Form::checkbox('other','w','',array('id' => 'o_w'))}}
				<br/>
				{{Form::label('o_x','Execute')}}
				{{Form::checkbox('other','x','',array('id' => 'o_x'))}}
			</fieldset>
		</div>
		<h1>Absulute Notation (octal) </h1>
		{{Form::text('octal','0000',array('readonly','id' => 'octal'))}}
	</div>
@stop

@section('javascript')
	<script type="text/javascript">
		$('document').ready(function(){
			$('input:checkbox').click(function(){
				var special = '';
				$("input[name='special']:checked").each(function(){
					special +=($(this).val())
				});
				var user = '';
				$("input[name='user']:checked").each(function(){
					user +=($(this).val())
				});
				var group = '';
				$("input[name='group']:checked").each(function(){
					group +=($(this).val())
				});
				var other = '';
				$("input[name='other']:checked").each(function(){
					other +=($(this).val())
				});
				$.ajax({
					url: "call-permission",
					type: "POST",
					dataType: "text",
					data: {
						special: special,
						user : user,
						group : group,
						other : other,
					},
					success: function(data) {
						data = JSON.parse(data);
						$('#octal').empty();
						$('#octal').val(data);
					},
					error: function(data) {
						alert(1)
					}
				});
			});
		});
	</script>
@stop