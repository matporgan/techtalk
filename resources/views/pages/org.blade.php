@extends('layout')

@section('content')

<div class="row">
	<div class="col">
		
	</div>
</div>
<div class="row">
	<div class="col s12 m8 l9">
		<div class="card-panel advisian-blue white-text" style="padding: 0px 40px 5px 30px;">
			<div class="row">
				<div class="col">
					<h1>{!! $org->name !!}</h1>
					Created by 
					@foreach($org->users as $user)
						@if($user->pivot->org_role == 'owner')
							<a href="mailto:{{ $user->email }}" class="white-text">{{ $user->name }}</a>
						@endif
					@endforeach
				</div>
			</div>
		</div>
		<div class="card-panel" style="padding: 10px 40px 5px 40px;">
			<div class="row">
				<h2>Description</h2>

				<p>{!! nl2br($org->short_desc) !!}</p>

		    	<p>{!! nl2br($org->long_desc) !!}</p>
			</div>
		</div>
		<div class="card-panel" style="padding: 10px 40px 5px 40px;">
			<div class="row">
		    	<h2>Documents
		    		@can('update-org', $org)
		    			<a class="fancybox btn-floating btn waves-effect waves-light right" href="#document-lightbox"><i class="material-icons">add</i></a>
		    		@endcan
		    	</h2>
				<ul class="collapsible" data-collapsible="accordion">
					@if($org->documents->isEmpty())
						<li><div class="collapsible-header"><i class="material-icons">attachment</i>(No Documents)</div></a></li>
					@endif
					@foreach($org->documents as $document)
						<li>
							<div class="collapsible-header"><i class="material-icons">attachment</i>{{ $document->name }}</div></a>
							<div class="collapsible-body">
								<p>
									{!! nl2br($document->description) !!}<br /><br />
									<a class="btn" href="{{ $org->id }}/document/{{ $document->id }}"><i class="material-icons left">file_download</i>Download</a>
									@can('update-org', $org)
										<a class="btn red right" href="{{ $org->id }}/document/{{ $document->id }}/delete"><i class="material-icons">close</i></a>
										<a class="btn green right" href="{{ $org->id }}/document/{{ $document->id }}/edit"><i class="material-icons">edit</i></a>
									@endcan
								</p>
							</div>
						</li>
					@endforeach
				</ul>
			</div>

			<div class="row">
				<h2>Links
					@can('update-org', $org)
						<a class="fancybox btn-floating btn waves-effect waves-light right" href="#link-lightbox"><i class="material-icons">add</i></a>
					@endcan
				</h2>
				<ul class="collapsible" data-collapsible="accordion">
					@if($org->links->isEmpty())
						<li><div class="collapsible-header"><i class="material-icons">link</i>(No Links)</div></a></li>
					@endif
					@foreach($org->links as $link)
						<li>
							<div class="collapsible-header"><i class="material-icons">link</i>{{ $link->url }}</div></a>
							<div class="collapsible-body">
								<p>
									{!! nl2br($link->description) !!}<br /><br />
									<a class="btn" href="{{ $link->url }}" target="_blank"><i class="material-icons left">open_in_new</i>Go To</a>
									@can('update-org', $org)
										<a class="btn red right" href="{{ $org->id }}/link/{{ $link->id }}/delete"><i class="material-icons">close</i></a>
										<a class="btn green right" href="{{ $org->id }}/link/{{ $link->id }}/edit"><i class="material-icons">edit</i></a>
									@endcan
								</p>
							</div>
						</li>
					@endforeach
				</ul>
			</div>

			<div class="row">
				<h2>Contacts
					@can('update-org', $org)
						<a class="fancybox btn-floating btn waves-effect waves-light right" href="#contact-lightbox"><i class="material-icons">add</i></a>
					@endcan
				</h2>				<ul class="collapsible" data-collapsible="accordion">
					@if($org->contacts->isEmpty())
						<li><div class="collapsible-header"><i class="material-icons">person</i>(No Contacts)</div></a></li>
					@endif
					@foreach($org->contacts as $contact)
						<li>
							<div class="collapsible-header"><i class="material-icons">person</i>{{ $contact->name }}</div></a>
							<div class="collapsible-body">
								<p>
									This section will explain their relationship to the org.<br /><br />
									<a class="btn" href="mailto:{{ $contact->email }}" target="_blank"><i class="material-icons left">email</i>Contact</a>
									@can('update-org', $org)
										<a class="btn red right" href="{{ $org->id }}/contact/{{ $contact->id }}/delete"><i class="material-icons">close</i></a>
										<a class="btn green right" href="{{ $org->id }}/contact/{{ $contact->id }}/edit"><i class="material-icons">edit</i></a>
									@endcan
								</p>
							</div>
						</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>

	<div class="col s12 m4 l3" style="padding: 8px 0 0 30px;">
		<div class="row">
				@can('update-org', $org)
					<a href="{{ $org->id }}/edit" class="btn green"><i class="material-icons">edit</i></a>
					<a href="{{ $org->id }}/delete" class="btn red"><i class="material-icons">close</i></a>
				@endcan
		</div>
		
		<div class="row">
			<img src="{{ $org->logo }}" alt="{{ $org->name . " - Logo" }}" class="logo" />
		</div>

		<div class="row">
			<a href="{{ $org->website }}">{{ $org->website }}</a>
		</div>

		<div class="row">
			<h3>Technologies</h3>
			@foreach($org->technologies as $technology)
				<a href="/technology/{{ $technology->id }}">
					<div class="chip">{{ $technology->name }}</div>
				</a>
			@endforeach
		</div>

		<div class="row">
			<h3>Industries</h3>
			@foreach($org->industries as $industry)
				<a href="/industry/{{ $industry->id }}">
					<div class="chip">{{ $industry->name }}</div>
				</a>
			@endforeach
		</div>

		<div class="row">
			<h3>Domains</h3>
			@foreach($org->domains as $domain)
				<a href="/domain/{{ $domain->id }}">
					<div class="chip">{{ $domain->name }}</div>
				</a>
				<!--@if($domain->industry_id == $industry->id)-->
				<!--	<li><a href="/domain/{{ $domain->id }}">{{ $domain->name }}</a></li>-->
				<!--@endif-->
			@endforeach
		</div>

		@if(! $org->tags->isEmpty())
			<div class="row">
				<h3>Tags</h3>
				@foreach($org->tags as $tag)
					<a href="/tag/{{ $tag->id }}">
						<div class="chip">{{ $tag->name }}</div>
					</a>
				@endforeach
			</div>
		@endif

		<div class="row">
			<h3>Creator</h3>
			@foreach($org->users as $user)
				@if($user->pivot->org_role == 'owner')
					<a href="mailto:{{ $user->email }}" target="_top">{{ $user->name }}</a>
				@endif
			@endforeach
		</div>
		
		<div class="row">
			@if($org->users->count() == 1)
				@can('update-org', $org)
					<h3>Contributors</h3>
				@endcan	
			@else
				<h3>Contributors</h3>
			@endif
			@foreach($org->users as $user)
				@if($user->pivot->org_role == 'contributor')
					<a href="mailto:{{ $user->email }}" target="_top">{{ $user->name }}</a>
					@can('update-org', $org)
						 | <a href="{{ $org->id }}/contributor/{{ $user->id }}/delete" class="red-text">Delete</a><br />
					@endcan
				@endif
			@endforeach
			@can('update-org', $org)
				<a class="fancybox btn" href="#contributor-lightbox" style="margin-top: 10px;"><i class="material-icons left">add</i>Add</a>
			@endcan
		</div>
	</div>
</div>
	
@can('update-org', $org)
	@include('forms.document')
	@include('forms.link')
	@include('forms.contact')
	@include('forms.contributor')
@endcan

@stop