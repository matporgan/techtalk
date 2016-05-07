@extends('layout')

@section('content')
	
<h1 class="center">Add Organisation</h1><br />

<div class="row">
	{!! Form::open(['method' => 'POST', 'action' => ['OrgsController@store'], 'files' => true, 'class' => 'col s12 m8 l6 offset-m2 offset-l3']) !!}
	    @include('forms.create-org', ['type' => 'create', 'submitText' => 'Add Organisation'])
	{!! Form::close() !!}
</div>

@stop