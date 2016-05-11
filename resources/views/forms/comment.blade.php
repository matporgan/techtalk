{!! Form::open(['method' => 'POST', 'action' => ['CommentsController@store', $org->id, 0], 'class' => 'col s12', 'onsubmit' => 'return validateForm()']) !!}
    <div class="input-field">
		{!! Form::textarea('body', null, ['class' => 'materialize-textarea']) !!}
		{!! Form::label('body', 'Add Comment', ['class' => 'active']) !!}
	</div>

	<div class="row right">
		<button class="btn waves-effect waves-light" type="submit" name="action">
		    Submit<i class="material-icons right">send</i>
	  	</button>
	</div>
{!! Form::close() !!}