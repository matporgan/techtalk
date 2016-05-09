@extends('layout')

@section('content')

<div class="row">
	<div class="col">
		<h1>{!! $org->name !!}</h1>
	</div>
	<div class="admin-btns col right">
		@can('update-org', $org)
			<a href="{{ $org->id }}/edit" class="btn"><i class="material-icons left">edit</i>Edit</a>
			<a href="{{ $org->id }}/delete" class="btn red"><i class="material-icons left">close</i>Delete</a>
		@endcan
	</div>
</div>
<div class="row">
	<div class="col s12 m9">
		<div class="card-panel">
			<p>Contributor: 
			@foreach($org->users as $user)
				@if($user->pivot->org_role == 'owner')
					<a href="mailto:{{ $user->email }}" target="_top">{{ $user->name }}</a>
				@endif
			@endforeach
			</p>
        	<p class="">{{ $org->short_desc }}</p>
        	<p class="">{{ $org->long_desc }}</p>
        </div>
		
		<p>{{ $org->short_desc }}</p>
		<br/><br/>
		{{ $org->long_desc }}<br/><br/>
		<br/><br/>
	</div>
	<div class="col s12 m3">
		<div class="card-panel">
		<div class="row">
			<img src="{{ $org->logo }}" alt="{{ $org->name . " - Logo" }}" class="logo" />
		</div>
		<div class="row">
			<h5>Website</h5>
			<a href="{{ $org->website }}">{{ $org->website }}</a>
		</div>
		<div class="row">
			<h5>Technologies</h5>
			@foreach($org->technologies as $technology)
				<a href="/technology/{{ $technology->id }}">
					<div class="chip">{{ $technology->name }}</div>
				</a>
			@endforeach
		</div>
		<div class="row">
			<h5>Industries</h5>
			@foreach($org->industries as $industry)
				<a href="/industry/{{ $industry->id }}">
					<div class="chip">{{ $industry->name }}</div>
				</a>
			@endforeach
		</div>
		<div class="row">
			<h5>Domains</h5>
			@foreach($org->domains as $domain)
				<a href="/domain/{{ $domain->id }}">
					<div class="chip">{{ $domain->name }}</div>
				</a>
				<!--@if($domain->industry_id == $industry->id)-->
				<!--	<li><a href="/domain/{{ $domain->id }}">{{ $domain->name }}</a></li>-->
				<!--@endif-->
			@endforeach
		</div>
		<div class="row">
			<h5>Tags</h5>
			@foreach($org->tags as $tag)
				<a href="/tag/{{ $tag->id }}">
					<div class="chip">{{ $tag->name }}</div>
				</a>
			@endforeach
		</div>
		</div>
	</div>
</div

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
		<li><a href="mailto:{{ $contact->email }}" target="_top">{{ $contact->name }}</a>
		@can('update-org', $org)
			<a href="{{ $org->id }}/contact/{{ $contact->id }}/delete" class="btn btn-xs btn-danger">Delete</a></li>
		@endcan
	@endforeach
</ul>

Contributors: 
<ul>
	@foreach($org->users as $user)
		@if($user->pivot->org_role == 'contributor')
			<li><a href="mailto:{{ $user->email }}" target="_top">{{ $user->name }}</a>
			@can('update-org', $org)
				<a href="{{ $org->id }}/contributor/{{ $user->id }}/delete" class="btn btn-xs btn-danger">Delete</a></li>
			@endcan
		@endif
	@endforeach
</ul>
	
@can('update-org', $org)

	<div class="row">
		<a class="fancybox btn btn-primary" href="#document-lightbox">+ Add Document</a>
	</div>
	@include('forms.document')

	<div class="row">
		<a class="fancybox btn btn-primary" href="#link-lightbox">+ Add Link</a>
	</div>
	@include('forms.link')
	
	<div class="row">
		<a class="fancybox btn btn-primary" href="#contact-lightbox">+ Add Contact</a>
	</div>
	@include('forms.contact')

	<div class="row">
		<a class="fancybox btn btn-primary" href="#contributor-lightbox">+ Add Contributor</a>
	</div>
	@include('forms.contributor')

@endcan

@stop