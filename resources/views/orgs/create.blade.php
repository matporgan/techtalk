@extends('layouts.app')

@section('content')
	
<h1 class="center">Add Organisation</h1><br />

<div class="row">
	{!! Form::open(['method' => 'POST', 'action' => ['OrgsController@store'], 'files' => true, 'class' => 'org-create col s12 m8 l6 offset-m2 offset-l3', 'onsubmit' => 'return validateForm()']) !!}
	    @include('orgs.forms.create-edit', ['type' => 'create'])
	{!! Form::close() !!}
</div>

@stop