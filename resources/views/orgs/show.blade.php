@extends('layouts.app')

@section('content')

<div class="row">

	<div class="col s12 m8 l9">
		
		@include('orgs._description')

		@include('orgs._attachments')

		<div class="card-panel" style="padding: 10px 40px 5px 40px;">
			<div class="row">
				<h2 id="discussion">Discussion</h2>
			</div>
			@include('comments._index', ['comment_prompt' => 'Add Comment'])
		</div>

	</div>

	<div class="col s12 m4 l3" style="padding: 8px 0 0 30px;">
		
		@include('orgs._categories')

	</div>

</div>
	
@can('update-org', $org)

	@include('orgs.forms.document')

	@include('orgs.forms.link')

	@include('orgs.forms.contact')

	@include('orgs.forms.contributor')

@endcan

@include('orgs._js')

@stop