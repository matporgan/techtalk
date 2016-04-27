@extends('layout')

@section('content')

	@foreach ($orgs as $org)
		<div>
			<a href="/orgs/{{ $org->id . "/" . str_replace(' ', '-', $org->name) }}">{{ $org->name }}</a>
		</div>
	@endforeach

@stop