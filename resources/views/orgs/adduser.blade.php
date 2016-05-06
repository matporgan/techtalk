@extends('layout')

@section('content')

{!! Form::open(['method' => 'POST', 'action' => ['OrgsController@adduser', $org->id]]) !!}
	<h2>Add Contributor</h2>
	<p>Note: the user has to have registered using this email</p>
	<div class="form-group">
		{!! Form::label('email', 'Email:') !!}
		{!! Form::text('email', null, ['class' => 'form-control', 'required']) !!}
	</div>
	
	<div class="form-group">
		{!! Form::submit('Add Contributor', ['class' => 'btn btn-primary']) !!}
	</div>
{!! Form::close() !!}

@stop