@extends('layout')

@section('content')
	
<h1>Add Organisation</h1>

<div class="row">
	{!! Form::open(['method' => 'POST', 'action' => ['OrgsController@store'], 'files' => true, 'class' => 'col s12']) !!}
	    @include('forms.org', ['type' => 'create', 'submitText' => 'Add Organisation'])
	{!! Form::close() !!}
</div>

@stop