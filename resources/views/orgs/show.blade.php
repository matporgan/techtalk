@extends('layout')

@section('content')
	
	<h1>{!! $org->name !!}</h1>
	<p>
		{{ $org->logo }}<br/>
		{{ $org->short_desc }}<br/>
		{{ $org->long_desc }}<br/>
		{{ $org->website }}<br/><br/>

		Technologies:
		<ul>
			@foreach($org->technologies as $technology)
				<li>{{ $technology->name }}</li>
			@endforeach
		</ul>

		Industries:
		<ul>
			@foreach($org->industries as $industry)
				<li>{{ $industry->name }}</li>
			@endforeach
		</ul>

		Cycles:
		<ul>
			@foreach($org->cycles as $cycle)
				<li>{{ $cycle->name }}</li>
			@endforeach
		</ul>

		Phases:
		<ul>
			@foreach($org->phases as $phase)
				<li>{{ $phase->name }}</li>
			@endforeach
		</ul>

		Tags:
		<ul>
			@foreach($org->tags as $tag)
				<li>{{ $tag->name }}</li>
			@endforeach
		</ul>
	</p>

	<a href="{{ $org->id }}/edit">EDIT</a> | <a href="{{ $org->id }}">DELETE</a>

@stop