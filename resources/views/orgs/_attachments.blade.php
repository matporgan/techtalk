@if( !$org->documents->isEmpty() || !$org->links->isEmpty() || !$org->contacts->isEmpty() || (Auth::check() && Auth::user()->can('update-org', $org)) )
	<div class="card-panel org-body">
		
		<!-- DOCUMENT ATTACHMENTS -->
		@if( !$org->documents->isEmpty() || (Auth::check() && Auth::user()->can('update-org', $org)) )
			<div class="row">
				<h2>Documents
					@can('update-org', $org)
						<a class="btn-floating btn waves-effect waves-light right modal-trigger" href="#document-modal"><i class="material-icons">add</i></a>
					@endcan
				</h2>
				<ul class="collapsible" data-collapsible="accordion">
					@if($org->documents->isEmpty())
						<li><div class="collapsible-header"><i class="material-icons">attachment</i>(No Documents)</div></a></li>
					@endif
					@foreach($org->documents as $document)
						<li>
							<div class="collapsible-header"><i class="material-icons">attachment</i>{{ $document->name . '.' . $document->ext }}</div></a>
							<div class="collapsible-body">
								<p>
									{!! nl2br($document->description) !!}<br /><br />
									<a class="btn" href="{{ $org->id }}/document/{{ $document->id }}"><i class="material-icons left">file_download</i>Download</a>
									@can('update-org', $org)
										<a class="btn red right modal-trigger" href="#delete-document-{{ $document->id }}"><i class="material-icons">close</i></a>
										<a class="btn green right margin-right modal-trigger" href="#edit-document-{{ $document->id }}"><i class="material-icons">edit</i></a>
									@endcan
								</p>
							</div>
						</li>

						<!-- EDIT FORM -->
						<div id="edit-document-{{ $document->id }}" class="modal modal-form">
						    <div class="modal-content">
						    	<h2 class="center">Edit Document</h2><br />
								{!! Form::model($document, ['method' => 'PATCH', 'action' => ['DocumentsController@update', $org->id, $document->id], 'files' => true, 'id' => 'document-form']) !!}
									@include('orgs.forms.document', ['type' => 'edit', 'submitText' => 'Update Document'])
								{!! Form::close() !!}
							</div>
						</div>


						<!-- DELETE CONFIRMATION -->
						<div id="delete-document-{{ $document->id }}" class="modal modal-confirm">
							<div class="modal-content">
								<h4>Delete Document</h4>
								<p>Are you sure you wish to delete "{{ $document->name }}"?</p>
							</div>
							<div class="modal-footer">
								<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
								<a href="{{ $org->id }}/document/{{ $document->id }}/delete" class="modal-action modal-close waves-effect waves-green btn-flat">Yes</a>
							</div>
						</div>
					@endforeach
				</ul>
			</div>
		@endif

		<!-- LINK ATTACHMENTS -->
		@if( !$org->links->isEmpty() || (Auth::check() && Auth::user()->can('update-org', $org)) )
			<div class="row">
				<h2>Links
					@can('update-org', $org)
						<a class="btn-floating btn waves-effect waves-light right modal-trigger" href="#link-modal"><i class="material-icons">add</i></a>
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
									<a class="btn" href="@if(substr($link->url, 0, 4) != 'http')http://{{ $link->url }}@else{{ $link->url }}@endif" target="_blank"><i class="material-icons left">open_in_new</i>Go To</a>
									@can('update-org', $org)
										<a class="btn red right modal-trigger" href="#delete-link-{{ $link->id }}"><i class="material-icons">close</i></a>
										<a class="btn green right margin-right modal-trigger" href="#edit-link-{{ $link->id }}"><i class="material-icons">edit</i></a>
									@endcan
								</p>
							</div>
						</li>

						<!-- EDIT FORM -->
						<div id="edit-link-{{ $link->id }}" class="modal modal-form">
						    <div class="modal-content">
						    	<h2 class="center">Edit Link</h2><br />
								{!! Form::model($link, ['method' => 'PATCH', 'action' => ['LinksController@update', $org->id, $link->id], 'id' => 'link-form']) !!}
									@include('orgs.forms.link', ['submitText' => 'Update Link'])
								{!! Form::close() !!}
							</div>
						</div>

						<!-- DELETE CONFIRMATION -->
						<div id="delete-link-{{ $link->id }}" class="modal modal-confirm">
							<div class="modal-content">
								<h4>Delete Link</h4>
								<p>Are you sure you wish to delete "{{ $link->URL }}"?</p>
							</div>
							<div class="modal-footer">
								<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
								<a href="{{ $org->id }}/link/{{ $link->id }}/delete" class="modal-action modal-close waves-effect waves-green btn-flat">Yes</a>
							</div>
						</div>
					@endforeach
				</ul>
			</div>
		@endif

		<!-- CONTACT ATTACHMENTS -->
		@if( !$org->contacts->isEmpty() || (Auth::check() && Auth::user()->can('update-org', $org)) )
			<div class="row">
				<h2>Internal Contacts
					@can('update-org', $org)
						<a class="btn-floating btn waves-effect waves-light right modal-trigger" href="#contact-modal"><i class="material-icons">add</i></a>
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
									@if($contact->relationship != "")
										{!! nl2br($contact->relationship) !!}<br /><br />
									@endif
									<a class="btn" href="mailto:{{ $contact->email }}" target="_blank"><i class="material-icons left">email</i>Contact</a>
									@can('update-org', $org)
										<a class="btn red right modal-trigger" href="#delete-contact-{{ $contact->id }}"><i class="material-icons">close</i></a>
										<a class="btn green right margin-right modal-trigger" href="#edit-contact-{{ $contact->id }}"><i class="material-icons">edit</i></a>
									@endcan
								</p>
							</div>
						</li>

						<!-- EDIT FORM -->
						<div id="edit-contact-{{ $contact->id }}" class="modal modal-form">
						    <div class="modal-content">
						    	<h2 class="center">Edit Internal Contact</h2><br />
								{!! Form::model($contact, ['method' => 'PATCH', 'action' => ['ContactsController@update', $org->id, $contact->id], 'id' => 'contact-form']) !!}
									@include('orgs.forms.contact', ['submitText' => 'Update Contact'])
								{!! Form::close() !!}
							</div>
						</div>

						<!-- DELETE CONFIRMATION -->
						<div id="delete-contact-{{ $contact->id }}" class="modal modal-confirm">
							<div class="modal-content">
								<h4>Delete Contact</h4>
								<p>Are you sure you wish to delete "{{ $contact->name }}"?</p>
							</div>
							<div class="modal-footer">
								<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
								<a href="{{ $org->id }}/contact/{{ $contact->id }}/delete" class="modal-action modal-close waves-effect waves-green btn-flat">Yes</a>
							</div>
						</div>
					@endforeach
				</ul>
			</div>
		@endif
	</div>
@endif