@include('forms.js-lightbox')

<div id="link_form" class="lightbox" style="display:none;">
	{!! Form::open(['method' => 'POST', 'action' => ['LinksController@store', $org->id]]) !!}
		<h2>Add Link</h2>
		<div class="input-field">
			{!! Form::label('url', 'URL:') !!}
			{!! Form::text('url', null, ['class' => 'form-control']) !!}
		</div>
		
		<div class="input-field">
			{!! Form::label('description', 'Description:') !!}
			{!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2']) !!}
		</div>
		
		<div class="input-field">
			{!! Form::submit('Add Link', ['class' => 'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
</div>