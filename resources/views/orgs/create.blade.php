@extends('layouts.app')

@section('content')

<div class="container">

<div class="row">

	<div class="col s12 m8 l6 offset-m2 offset-l3">

		<div class="row">
			<h1 class="center">Add Organisation</h1>
		</div>

		<div class="row">
			{!! Form::open(['method' => 'POST', 'action' => ['OrgsController@store'], 'files' => true, 'class' => 'org-create', 'onsubmit' => 'return validateForm()']) !!}
			    @include('orgs.forms.create-edit', ['type' => 'create'])
			{!! Form::close() !!}
		</div>
	</div>
</div>

</div>

@stop
