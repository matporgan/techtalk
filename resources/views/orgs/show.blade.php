@extends('layout')

@section('content')
	
	<h1>{!! $org->name !!}</h1>
	@if(Auth::id() == $org->user_id) 
		<a href="/orgs/{{ $org->id }}/delete" class="btn btn-xs btn-danger">Delete</a>
	@endif

	<img src="{{ $org->logo }}" alt="{{ $org->name . " - Logo" }}" class="logo" />

	<p>
		<br/>
		{{ $org->short_desc }}<br/><br/>
		{{ $org->long_desc }}<br/><br/>
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
				<li>
					<a href="/document/{{ $document->id }}">{{ $document->name }} | {{ $document->description }}</a>
					@if(Auth::id() == $org->user_id) 
						<a href="/document/{{ $document->id }}/delete" class="btn btn-xs btn-danger">Delete</a>
					@endif
				</li>
			@endforeach
		</ul>

		Links:
		<ul>
			@foreach($org->links as $link)
				<li><a href="{{ $link->url }}">{{ $link->url }} | {{ $link->description }}</a><a href="/link/{{ $link->id }}/delete" class="btn btn-xs btn-danger">Delete</a></li>
			@endforeach
		</ul>

		Contacts:
		<ul>
			@foreach($org->contacts as $contact)
				<li><a href="mailto:{{ $contact->email }}">{{ $contact->name }}</a><a href="/contact/{{ $contact->id }}/delete" class="btn btn-xs btn-danger">Delete</a></li>
			@endforeach
		</ul>
	</p>
	@if(Auth::id() == $org->user_id) 

		@include('documents.show')

		@include('links.show')
		
		@include('contacts.show')

		<a href="{{ $org->id }}/edit">EDIT</a> | <a href="{{ $org->id }}">DELETE</a>
	@endif
	
@stop