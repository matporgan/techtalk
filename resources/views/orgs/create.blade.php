@extends('layout')

@section('content')
	
<h1>Add Organisation</h1>

<div class="row">
	{!! Form::open(['method' => 'POST', 'action' => ['OrgsController@store'], 'files' => true, 'class' => 'col-md-12']) !!}
	    @include('orgs._form', ['submitText' => 'Add Organisation'])
	{!! Form::close() !!}
</div>

@stop