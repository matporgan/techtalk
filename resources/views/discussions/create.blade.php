@extends('layout')

@section('content')
	
<h1 class="center">Add Discussion</h1><br />

<div class="row">
	{!! Form::open(['method' => 'POST', 'action' => ['DiscussionsController@store'], 'id' => 'discussion-create', 'class' => 'col s12 m8 l6 offset-m2 offset-l3']) !!}
	    @include('discussions.forms.create')
	{!! Form::close() !!}
</div>

@stop