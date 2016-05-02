@include('links._form-js')

<div id="link_form" class="lightbox" style="display:none;">
	{!! Form::open(['method' => 'POST', 'action' => ['LinksController@addLink', $org->id]]) !!}
		<h2>Add Link</h2>
		<div class="form-group">
			{!! Form::label('url', 'URL:') !!}
			{!! Form::text('url', null, ['class' => 'form-control']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::label('description', 'Description:') !!}
			{!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::submit('Add Link', ['class' => 'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
</div>