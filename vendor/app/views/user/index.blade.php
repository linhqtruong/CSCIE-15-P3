@extends('layouts.master')

@section('content')
	@if ($errors->has('user'))
		<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			{{$errors->first('user')}}
			<br>
		</div>
	@endif
	<a href="/"> Home </a>
	<h1>User Generate</h1>
	{{ Form::open(array('method' => 'post'))}}
		{{ Form::label('user','How many users')}}
		{{ Form::text('user','5')}}
		(Max: 99)
		<br>
		Include...
		<br>
		{{ Form::checkbox('birthday','1',null,array('id'=>'birthday'))}}
		{{ Form::label('birthday','Birthday')}}
		<br>
		{{ Form::checkbox('profile','1',null,array('id'=>'profile'))}}
		{{ Form::label('profile','Profile')}}
		<br><br>
		{{ Form::submit('Generate!!!')}}
	{{ Form::close()}}
	@if (isset($result))
		<div class="users">
			@foreach ($result as $value)
				<div class="user">
					<div class="name"> {{{$value['name']}}}</div>
					@if (isset($value['birthday']))
						<div class="birthday"> {{{$value['birthday']}}} </div>
					@endif
					@if (isset($value['profile'])) 
						<div class="profile"> {{{$value['profile']}}} </div>
					@endif
				</div>
			@endforeach
		</div>
	@endif
@stop

@section('stylesheet')
<style type="text/css">
	.container {
		margin-top: 15px;
	}
	.users {
		margin-top: 15px;
	}
	.user {
		margin-bottom: 5px;
	}
	.name {
		font-weight: bold;
	}
	.profile {
		font-style: italic;
	}
</style>
@stop