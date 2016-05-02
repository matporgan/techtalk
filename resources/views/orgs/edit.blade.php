@extends('layout')

@section('content')
	
<h1>Edit: {{ $org->name }}</h1>

<div class="row">
	{!! Form::model($org, ['method' => 'PATCH', 'action' => ['OrgsController@update', $org->id], 'files' => true, 'class' => 'col-md-12']) !!}
	    @include('orgs._form', ['submitText' => 'Update Organisation'])
	{!! Form::close() !!}
</div>

@stop