@extends('layouts.master_simple')

@section('content')
	<div id="tabs-2" style="display: block;">
		<h1>Decode Octal Notation</h1>
		<div class="help">
			<p>Enter an octal code below and the tool will tell you what permissions correspond to that code.</p>
		</div>
		{{Form::open(array('method' => 'post', 'id' => 'form-main'))}}
			<div id="initial">
					{{Form::label('initial','Permissions (octal)')}}
				<p>
					{{Form::text('initial','0000',array('maxlength' => '4', 'id' => 'initial'))}}
				</p>
				{{Form::submit('Submit',array('class'=>'btn-button'))}}
				@if (isset($errors))
				<p class="error" style="color:red">
					{{$errors->first('initial')}}
				</p>
				@endif
			</div>
			<h2>Permission bits</h2>
			<div id="result">
				<table width="100%" cellspacing="0" border="1px">
					<thead>
						<tr>
							<th>Special</th>
							<th>User</th>
							<th>Group</th>
							<th>Other</th>
						</tr>
					</thead>
					<tbody>
						@if (isset($result))
						<tr>
							<td>
								{{ ($result['special']['u'] == 0) ? 'setuid is unset' : 'setuid is set'}} 
							</td>
							<td> 
								{{ ($result['user']['r'] == 0) ? 'cannot read' : 'can read'}} 
							</td>
							<td>
								{{ ($result['group']['r'] == 0) ? 'cannot read' : 'can read'}}
							</td>
							<td>
								{{ ($result['other']['r'] == 0) ? 'cannot read' : 'can read'}}
							</td>
						</tr>
						<tr>
							<td>
								{{ ($result['special']['g'] == 0) ? 'setgid is unset' : 'setgid is set'}} 
							</td>
							<td> 
								{{ ($result['user']['w'] == 0) ? 'cannot write' : 'can write'}} 
							</td>
							<td>
								{{ ($result['group']['w'] == 0) ? 'cannot write' : 'can write'}}
							</td>
							<td>
								{{ ($result['other']['w'] == 0) ? 'cannot write' : 'can write'}}
							</td>
						</tr>
						<tr>
							<td>
								{{ ($result['special']['o'] == 0) ? 'Sticky is unset' : 'Sticky is set'}} 
							</td>
							<td> 
								{{ ($result['user']['x'] == 0) ? 'cannot execute' : 'can execute'}} 
							</td>
							<td>
								{{ ($result['group']['x'] == 0) ? 'cannot execute' : 'can execute'}}
							</td>
							<td>
								{{ ($result['other']['x'] == 0) ? 'cannot execute' : 'can execute'}}
							</td>
						</tr>
						@else
						<tr>
							<td id="spec_uid"> setuid is unset </td>
							<td id="user_r"> cannot read </td>
							<td id="group_r"> cannot read </td>
							<td id="other_r"> cannot read </td>
						</tr>
						<tr>
							<td id="spec_gid"> setgid is unset </td>
							<td id="user_w"> cannot write </td>
							<td id="group_w"> cannot write </td>
							<td id="other_w"> cannot write </td>
						</tr>
						<tr>
							<td id="spec_sti"> Sticky is unset </td>
							<td id="user_x"> cannot execute </td>
							<td id="group_x"> cannot execute </td>
							<td id="other_x"> cannot execute </td>
						</tr>
						@endif
					</tbody>
				</table>
			</div>
		{{Form::close()}}
	</div>
@stop