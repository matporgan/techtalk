@include('forms.js-lightbox')

<div id="contact_form" class="lightbox" style="display:none;">
	{!! Form::open(['method' => 'POST', 'action' => ['ContactsController@store', $org->id]]) !!}
		<h2>Add Contact</h2>
		<div class="input-field">
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
		</div>
		
		<div class="input-field">
			{!! Form::label('email', 'Email:') !!}
			{!! Form::text('email', null, ['class' => 'form-control', 'required']) !!}
		</div>
		
		<div class="input-field">
			{!! Form::submit('Add Contact', ['class' => 'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
</div>