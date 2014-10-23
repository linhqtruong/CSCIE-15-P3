@extends('layouts.master')

@section('content')
	<div class="alert alert-danger alert-dismissable" id="alert">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
		<p></p>
	</div>
	<a href="/">Home </a>
	<h1>Password Generator</h1>
	{{ Form::open(array('method' => 'post'))}}
		<div class="ctinner">
			<fieldset>
				<legend>General</legend>
					{{ Form::label('num_word','Num word')}}
					{{ Form::selectRange('num_word',1,MAX_WORD,5)}}
					<br/><br/>
					{{ Form::label('max_length','Max length')}}
					{{ Form::input('number','max_length',50)}}
			</fieldset>
		</div>

		<div class="ctinner">
			<fieldset>
				<legend>Include</legend>
					{{ Form::label('incl_num_check','Include number')}}
					{{ Form::checkbox('incl_num_check','') }}
					<br/><br>
					Random
					{{ Form::radio('incl_num_type','r',null,array('disabled','checked'))}}
					Custom
					{{ Form::radio('incl_num_type','c',null,array('disabled'))}}
					{{ Form::selectRange('incl_num_cus_val',0,9,null,array('disabled'))}}
					{{ Form::selectRange('incl_num_size',1,MAX_NUMBER,null,array('disabled'))}}
					<br><br>
					{{ Form::label('incl_ss_check','Include special symbol')}}
					{{ Form::checkbox('incl_ss_check','') }}
					<br/><br>
					Random
					{{ Form::radio('incl_ss_type','r',null,array('disabled'))}}
					Custom
					{{ Form::radio('incl_ss_type','c',null,array('disabled'))}}
					{{ Form::select('incl_ss_cus_val',unserialize(SPEC_CHAR),null,array('disabled'))}}
					{{ Form::selectRange('incl_ss_size',1,MAX_NUMBER,null,array('disabled'))}}
			</fieldset>
		</div>
		<div class="ctinner">
			<fieldset>
				<legend>Separation</legend>
				{{ Form::label('sepa_type_none','None')}}
				{{ Form::radio('sepa_type','none',null,array('id' => 'sepa_type_none'))}}
				<br><br>
				{{ Form::radio('sepa_type','space',null,array('id'=> 'sepa_type_space'))}}
				{{ Form::label('sepa_type_space','Space')}}	
				<br><br>
				{{ Form::radio('sepa_type','hyphen',true,array('id'=>'sepa_type_hyphen'))}}
				{{ Form::label('sepa_type_hyphen','Hyphen')}}
			</fieldset>
		</div>

		<div class="ctinner">
			<fieldset>
				<legend>Case-transform</legend>
				{{ Form::radio('case_tfm_type','all_lower',null,array('id'=>'case_all_lower'))}}
				{{ Form::label('case_all_lower','all lower case')}}
				<br><br>
				{{ Form::radio('case_tfm_type','all_upper',null,array('id'=>'case_all_upper'))}}
				{{ Form::label('case_all_upper','ALL UPPER CASE')}}	
				<br><br>
				{{ Form::radio('case_tfm_type','first_char',true,array('id'=>'case_first_char'))}}
				{{ Form::label('case_first_char','The First Letter of the word')}}
			</fieldset>
		</div>
		<div class="ct">
			<a href="" id="btn-submit" class="button">Password Generate</a>
		</div>
		<br>
		<div class="ct">
			{{ Form::text('result',$result,array('class'=>'txt700','placeholder' => 'Result','id' => "pass_display",'readonly'))}}
		</div>
	{{ Form::close()}}
@stop

@section('stylesheet')
	{{-- expr --}}
	<style>
		.ctinner {
			margin-top: 0.6em;
			padding: 0.6em;
			display: inline-block;
			height: 15.5em;
			display: -moz-inline-stack;
			vertical-align: top;
		}
		fieldset {
			border: 1px solid #dedede;
			border-radius: 0.3em;
			width: 25em;
			min-height: 13.75em;
		}

		legend {
			padding: 0.2em 1em;
			border: 1px solid #dedede;
			font-weight: bold;
			font-size: 90%;
			background: white repeat 0 0;
			width: 98%;
			border-radius: 5px;
			margin: -0.5em auto 1em 0.2em;
			text-align: center;
		}

		label {
			float: left;
			min-width: 20%;
			margin-right: 0.2em;
			margin-left: 0.6em;
			margin-bottom: 0;
			margin-top: 0;
			text-align: right;
			font-weight: bold;
			clear: left;
		}
		.ct {
			margin-left:20px;
		}
		input{
			border-radius: 5px;
			border: 1px solid #dedede;
		}
		.txt700 {
			width: 750px;
		}
		#alert {
			display: none;
		}
		.button {
			-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
			-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
			box-shadow:inset 0px 1px 0px 0px #ffffff;
			background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f9f9f9), color-stop(1, #e9e9e9) );
			background:-moz-linear-gradient( center top, #f9f9f9 5%, #e9e9e9 100% );
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f9', endColorstr='#e9e9e9');
			background-color:#f9f9f9;
			-webkit-border-top-left-radius:0px;
			-moz-border-radius-topleft:0px;
			border-top-left-radius:0px;
			-webkit-border-top-right-radius:0px;
			-moz-border-radius-topright:0px;
			border-top-right-radius:0px;
			-webkit-border-bottom-right-radius:0px;
			-moz-border-radius-bottomright:0px;
			border-bottom-right-radius:0px;
			-webkit-border-bottom-left-radius:0px;
			-moz-border-radius-bottomleft:0px;
			border-bottom-left-radius:0px;
			text-indent:0;
			border:1px solid #dcdcdc;
			display:inline-block;
			color:#666666;
			font-family:Arial;
			font-size:15px;
			font-weight:bold;
			font-style:normal;
			height:40px;
			line-height:40px;
			width:200px;
			text-decoration:none;
			text-align:center;
			text-shadow:1px 1px 0px #ffffff;
		}
		.button:hover {
			background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #e9e9e9), color-stop(1, #f9f9f9) );
			background:-moz-linear-gradient( center top, #e9e9e9 5%, #f9f9f9 100% );
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e9e9e9', endColorstr='#f9f9f9');
			background-color:#e9e9e9;
		}
		.button:active {
			position:relative;
			top:1px;
		}
	</style>
@stop

@section('javascript')
	{{-- expr --}}
	{{ HTML::script('js/uicontrol.js')}}
@stop