<div class="input-field">
	{!! Form::label('name', 'Name*', ['class' => 'active']) !!}
	{!! Form::text('name', null) !!}
</div>

<div class="input-field">
	{!! Form::label('email', 'Email*', ['class' => 'active']) !!}
	{!! Form::text('email', null) !!}
</div><br />

<div class="input-field">
	{!! Form::label('relationship', 'Relationship') !!}
	{!! Form::textarea('relationship', null, ['class' => 'materialize-textarea', 'placeholder' => "What is the contact's relationship to the organisation?"]) !!}
</div><br />

<div class="row center">
	<button class="btn waves-effect waves-light" type="submit" name="action">
	    {{ $submitText }}
  	</button>
</div>