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