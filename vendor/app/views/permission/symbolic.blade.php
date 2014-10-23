@extends('layouts.master_simple')

@section('content')
	{{-- expr --}}
	<div id="tabs-3">
		<h1>Symbolic Notation</h1
		<p>Symbolic notation is used to change the permissions of files and directories relative to their current permissions.</p>
		<p>This tool can be used to explore how symbolic notations work.</p>
		<p>To use this tool set the current octal value of your file permissions and then select from the checkboxes below to create the target permissions for your file(s).</p>
		<h1>Current Permission(Octal)</h1>
		{{Form::open(array('method'=> 'POST', 'id' => 'form-main'))}}
		{{Form::text('initial','0000',array('id' => 'initial'))}}
		{{Form::submit('Update',array('id' => 'btn-update','class' => 'btn-button'))}}
		<h1>Permission Bits</h1>
		<div id="perms" class="clearfix">
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
			<p id="error"></p>
			<h1>Target Permissions (octal)</h1>
			{{Form::text('octal','0000',array('id' => 'octal','readonly'))}}
		<div>
			<h1>Result</h1>
			{{Form::text('result','No change',array('id' => 'result','readonly'))}}
		</div>
	</div>
@stop

@section('javascript')
	<script type="text/javascript">
		$('document').ready(function(){
			$('input:checkbox').click(function(){
				process();
			});
			$('#form-main').submit(function(){
				process();
				return false;
			})
			function process(){
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
				initial = $("#initial").val();
				$.ajax({
					url: "/call-permission/symbolic",
					type: "POST",
					dataType: "text",
					data: {
						special: special,
						user : user,
						group : group,
						other : other,
						initial: initial,
					},
					success: function(data) {
						data = JSON.parse(data);
						$('#octal').empty();
						$('#octal').val(data['target']);
						if (!data['result']){
							$('#result').val('No change');
						} else {
							$('#result').val(data['result']);
						}
						if (data['msg-error']) {
							$('#error').html(data['msg-error']['initial']);
						}
					},
					error: function(data) {
						alert('Sorry! This has a mirror error in the processing.');
					}
				});
			}
		});
	</script>
@stop