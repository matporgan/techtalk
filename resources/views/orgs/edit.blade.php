@extends('layouts.app')

@section('content')

<div class="container">
	
<h1 class="center">Edit: {{ $org->name }}</h1>

<div class="row">
	{!! Form::model($org, ['method' => 'PATCH', 'action' => ['OrgsController@update', $org->id], 'files' => true, 'class' => 'col s12 m8 l6 offset-m2 offset-l3', 'onsubmit' => 'return validateForm()']) !!}
	    @include('orgs.forms.create-edit', ['type' => 'edit'])
	{!! Form::close() !!}
</div>

</div>

@stop