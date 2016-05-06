@extends('layout')

@section('content')
	
	<h1>{!! $org->name !!}</h1>

	@if(Session::has('success'))
	    <div class="alert alert-success">
	        <p>{{ Session::get('success') }}</p>
	    </div>
	@elseif(Session::has('failure'))
	    <div class="alert alert-danger">
	        <p>{{ Session::get('failure') }}</p>
	    </div>
	@endif

	@can('update-org', $org)
		<a href="/orgs/{{ $org->id }}/delete" class="btn btn-xs btn-danger">Delete</a>
	@endcan

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
				<ul>
					@foreach($org->domains as $domain)
						@if($domain->industry_id == $industry->id)
							<li><a href="/domain/{{ $domain->id }}">{{ $domain->name }}</a></li>
						@endif
					@endforeach
				</ul>
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
					@can('update-org', $org)
						<a href="{{ $org->id }}/document/{{ $document->id }}/delete" class="btn btn-xs btn-danger">Delete</a>
					@endcan
				</li>
			@endforeach
		</ul>

		Links:
		<ul>
			@foreach($org->links as $link)
				<li><a href="{{ $link->url }}">{{ $link->url }} | {{ $link->description }}</a>
				@can('update-org', $org)
					<a href="{{ $org->id }}/link/{{ $link->id }}/delete" class="btn btn-xs btn-danger">Delete</a></li>
				@endcan
			@endforeach
		</ul>

		Contacts:
		<ul>
			@foreach($org->contacts as $contact)
				<li><a href="mailto:{{ $contact->email }}">{{ $contact->name }}</a>
				@can('update-org', $org)
					<a href="{{ $org->id }}/contact/{{ $contact->id }}/delete" class="btn btn-xs btn-danger">Delete</a></li>
				@endcan
			@endforeach
		</ul>
	</p>
		
	@can('update-org', $org)

		<div class="row">
			<a class="fancybox btn btn-primary" href="#document_form">+ Add Document</a>
		</div>
		@include('forms.document')

		<div class="row">
			<a class="fancybox btn btn-primary" href="#link_form">+ Add Link</a>
		</div>
		@include('forms.link')
		
		<div class="row">
			<a class="fancybox btn btn-primary" href="#contact_form">+ Add Contact</a>
		</div>
		@include('forms.contact')

		<div class="row">
			<a class="fancybox btn btn-primary" href="#contributor_form">+ Add Contributor</a>
		</div>
		@include('forms.contributor')
	
		<a href="{{ $org->id }}/edit">EDIT</a> | <a href="{{ $org->id }}">DELETE</a><br><br>
	@endcan
	

@stop