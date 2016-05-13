@extends('layout')

@section('content')

<div class="row">

	<div class="col s12 m8 l9">
		
		@include('org.description')

		@include('org.attachments')

		<div class="card-panel" style="padding: 10px 40px 5px 40px;">
			<div class="row">
				<h2 id="discussion">Discussion</h2>
			</div>
			@include('org.comments', ['comment_prompt' => 'Add Comment'])
		</div>

	</div>

	<div class="col s12 m4 l3" style="padding: 8px 0 0 30px;">
		
		@include('org.categories')

	</div>

</div>
	
@can('update-org', $org)

	@include('org.forms.document')

	@include('org.forms.link')

	@include('org.forms.contact')

	@include('org.forms.contributor')

@endcan

@include('org.js')

@stop