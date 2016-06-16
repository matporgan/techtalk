@extends('layouts.app')

@section('content')

<div class="container">

<div class="row">
	<div class="col s12">
		<h1 class="center"><span>#</span>Discuss</h1>
	</div>
			
	<div class="col s12 l10 offset-l1">
		<a class="btn right waves-effect waves-light" href="/discussions/create">Add New Topic</a>
	</div>
		
	<div class="col s12 l10 offset-l1">
		@include('discussions._board')
	</div>
</div>

</div>

@stop