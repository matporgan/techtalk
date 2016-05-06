@include('forms.js-lightbox')

<div id="contributor_form" class="lightbox" style="display:none;">
	{!! Form::open(['method' => 'POST', 'action' => ['OrgsController@adduser', $org->id]]) !!}
		<h2>Add Contributor</h2>
	
		<div class="form-group">
			{!! Form::label('email', 'Email:') !!}
			{!! Form::text('email', null, ['class' => 'form-control', 'required']) !!}
		</div>

		<p>Note: The user should have already registered with the above email.</p>

		<div class="form-group">
			{!! Form::submit('Add Contact', ['class' => 'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
</div>