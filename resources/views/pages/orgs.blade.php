@extends('layout')

@section('content')

	@foreach ($orgs as $org)
		<div>
			<a href="/orgs/{{ $org->id }}">{{ $org->name }}</a>
		</div>
	@endforeach

@stop