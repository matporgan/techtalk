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
				<li><a href="/technology/{{ $technology->id }}">{{ $technology->name }}</a></li>
			@endforeach
		</ul>

		Industries:
		<ul>
			@foreach($org->industries as $industry)
				<li><a href="/industry/{{ $industry->id }}">{{ $industry->name }}</a></li>
			@endforeach
		</ul>

		Domains:
		<ul>
			@foreach($org->domains as $domain)
				<li><a href="/domain/{{ $domain->id }}">{{ $domain->name }}</a></li>
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
					<a href="{{ $org->id }}/document/{{ $document->id }}">{{ $document->name }} | {{ $document->description }}</a>
					@if(Auth::id() == $org->user_id) 
						<a href="{{ $org->id }}/document/{{ $document->id }}/delete" class="btn btn-xs btn-danger">Delete</a>
					@endif
				</li>
			@endforeach
		</ul>

		Links:
		<ul>
			@foreach($org->links as $link)
				<li><a href="{{ $link->url }}">{{ $link->url }} | {{ $link->description }}</a>
				@if(Auth::id() == $org->user_id) 
					<a href="{{ $org->id }}/link/{{ $link->id }}/delete" class="btn btn-xs btn-danger">Delete</a></li>
				@endif
			@endforeach
		</ul>

		Contacts:
		<ul>
			@foreach($org->contacts as $contact)
				<li><a href="mailto:{{ $contact->email }}">{{ $contact->name }}</a>
				@if(Auth::id() == $org->user_id) 
					<a href="{{ $org->id }}/contact/{{ $contact->id }}/delete" class="btn btn-xs btn-danger">Delete</a></li>
				@endif
			@endforeach
		</ul>
	</p>
		
	@if(Auth::id() == $org->user_id)
		@include('documents.show')

		@include('links.show')
		
		@include('contacts.show')
		
	@endif
	
	<a href="{{ $org->id }}/edit">EDIT</a> | <a href="{{ $org->id }}">DELETE</a>

@stop