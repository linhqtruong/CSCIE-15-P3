@extends('layouts.master')

@section('content')
	{{-- expr --}}
	@if ($errors->has('paragraphs'))
		<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
			{{$errors->first('paragraphs')}}
			<br>
		</div>
	@endif
	<a href="/"> Home </a>
	<h1>Lorem Ipsum Generate</h1>
	How many paragraphs do you want?
	{{ Form::open(array('method' =>  'post'))}}
		{{ Form::label('paragraphs','Paragraphs') }}
		{{ Form::text('paragraphs','5')}} (Max: 99)
		<br><br>
		{{ Form::submit('Generate!!!')}}
	{{ Form::close()}}

	@if (isset($word)) 
		{{-- expr --}}
		<div class="paragraphs-output">
			{{ implode('<p>', $word) }}
		</div>
	@endif
@stop

@section('stylesheet')
	{{-- expr --}}
	<style type="text/css">
		.paragraphs-output {
			padding-top: 10px;
			text-align: justify;
		}
		.paragraphs-output p {
			margin-bottom: 5px;
		}
		input {
			border: 1px solid #cccccc;
			border-radius: 5px;
			margin-right: 5px;
			width: 150px;
		}
	</style>
@stop