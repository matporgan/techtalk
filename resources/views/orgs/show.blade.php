@extends('layout')

@section('content')
	
	<h1>{!! $org->name !!}</h1>
	<p>
	{{ $org->logo }}<br/>
	{{ $org->short_desc }}<br/>
	{{ $org->long_desc }}<br/>
	{{ $org->website }}<br/>
	</p>

@stop