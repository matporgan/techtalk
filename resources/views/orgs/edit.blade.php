@extends('layouts.app')

@section('content')
	
<h1 class="center">Edit: {{ $org->name }}</h1>

<div class="row">
	{!! Form::model($org, ['method' => 'PATCH', 'action' => ['OrgsController@update', $org->id], 'files' => true, 'class' => 'col s12 m8 l6 offset-m2 offset-l3']) !!}
	    @include('orgs.forms.create-edit', ['type' => 'edit'])
	{!! Form::close() !!}
</div>

@stop