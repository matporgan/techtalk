<div class="input-field">
	{!! Form::label('url', 'URL*') !!}
	{!! Form::text('url', null) !!}
</div>

<div class="input-field">
	{!! Form::label('description', 'Description*', ['class' => 'active']) !!}
	{!! Form::textarea('description', null, ['class' => 'materialize-textarea']) !!}
</div><br />

<div class="row center">
	<button class="btn waves-effect waves-light" type="submit" name="action">
	    {{ $submitText }}
  	</button>
</div>