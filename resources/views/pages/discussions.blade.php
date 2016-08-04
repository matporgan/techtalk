@extends('layouts.app')

@section('content')

<div class="container">

<div class="row">
	<div class="col s12">
		<h1 class="title center"><i class="material-icons">forum</i>Discuss</h1>
	</div>

	<div class="col s12 m8 l6 offset-m2 offset-l3">
		@include('orgs._search', ['type' => 'discussions'])
		<div class="space"></div>
		<div class="space"></div>
	</div>
	<div class="col s12 m2 l3">
		<div style="position:relative;">
			<a href="/discussions/create" class="btn-floating btn-large advisian-blue" style="position: absolute; display: inline-block; right: 0; top: 15px;">
				<i class="large material-icons">add</i>
			</a>
		</div>
	</div>

	<?php $query = isset($_GET['search']) ? $_GET['search'] : "" ?>
	<div class="col s12">
		@if(isset($query) && $query != "")
			<h3>{{ $discussions->total() }} @if($discussions->total() == 1) discussion @else discussions @endif found for:&nbsp;</h3>
			<h2>{{ $query }}</h2>
		@elseif(isset($category) && $category != "")
			<h3>{{ $discussions->total() }} @if($discussions->total() == 1) discussion @else discussions @endif found for the <b>{{ $type }}:&nbsp;</b></h3>
			<h2>{{ $category }}</h2>
		@else
			<h3>{{ $discussions->total() }} @if($discussions->total() == 1) discussion @else discussions @endif</h3>
		@endif

	</div>


	<div class="col s12">
		@include('discussions._board')
	</div>
</div>

</div>

@stop
