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

		Domains:
		<ul>
			@foreach($org->domains as $domain)
				<li>{{ $domain->name }}</li>
			@endforeach
		</ul>

		Tags:
		<ul>
			@foreach($org->tags as $tag)
				<li>{{ $tag->name }}</li>
			@endforeach
		</ul>

		Documents:
		<ul>
			@foreach($org->documents as $document)
				<li><a href="/document/{{ $document->id }}">{{ $document->name }} | {{ $document->description }}</a></li>
			@endforeach
		</ul>

		Links:
		<ul>
			@foreach($org->links as $link)
				<li><a href="{{ $link->url }}">{{ $link->url }} | {{ $link->description }}</a></li>
			@endforeach
		</ul>
	</p>



	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen" />

	<script type="text/javascript">
		$(document).ready(function() {
			$(".fancybox").fancybox({
				padding: 0
			});
		});
	</script>

	@include('documents.show')

	@include('links.show')
	

	<a href="{{ $org->id }}/edit">EDIT</a> | <a href="{{ $org->id }}">DELETE</a>
	
@stop