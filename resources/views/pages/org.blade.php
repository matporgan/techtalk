@extends('layouts.app')

@section('content')

<div class="container">

<div class="row">

	<div class="col s12 m8 l9">
		
		@include('orgs._description')
		
		@include('orgs._attachments')

		<div class="card-panel org-body">
			<div class="row">
				<h2 id="discussion">Discussion</h2>
			</div>
			@include('comments._index', ['comment_prompt' => 'Add Comment'])
		</div>

	</div>

	<div class="col s12 m4 l3 org-categories">
		
		@include('orgs._categories')

	</div>

</div>
	
@can('update-org', $org)

	<div id="document-modal" class="modal modal-form">
	    <div class="modal-content">
	    	<h2 class="center">Add Document</h2><br />
			{!! Form::open(['method' => 'POST', 'action' => ['DocumentsController@store', $org->id], 'files' => true, 'id' => 'document-form']) !!}
				@include('orgs.forms.document', ['type' => 'create', 'submitText' => 'Add Document'])
			{!! Form::close() !!}
		</div>
	</div>

	<div id="link-modal" class="modal modal-form">
	    <div class="modal-content">
	    	<h2 class="center">Add Link</h2><br />
			{!! Form::open(['method' => 'POST', 'action' => ['LinksController@store', $org->id], 'id' => 'link-form']) !!}
				@include('orgs.forms.link', ['submitText' => 'Add Link'])
			{!! Form::close() !!}
		</div>
	</div>

	<div id="contact-modal" class="modal modal-form">
	    <div class="modal-content">
	    	<h2 class="center">Add Internal Contact</h2><br />
			{!! Form::open(['method' => 'POST', 'action' => ['ContactsController@store', $org->id], 'id' => 'contact-form']) !!}
				@include('orgs.forms.contact', ['submitText' => 'Add Contact'])
			{!! Form::close() !!}
		</div>
	</div>

	@include('orgs.forms.contributor')

@endcan

@include('orgs._js')

</div>

@stop