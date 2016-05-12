{!! Form::open(['method' => 'POST', 'action' => ['CommentsController@store', $org->id, $parent_id], 'class' => 'col s12', 'id' => 'comment-reply-form']) !!}
    <div class="input-field">
		{!! Form::textarea('body', null, ['class' => 'materialize-textarea', 'id' => 'textarea-'.$comment->id]) !!}
		{!! Form::label('body', "Reply to ".$comment->user->name, ['class' => 'active']) !!}
	</div>

	<div class="row right">
		<button class="btn waves-effect waves-light" type="submit" name="action">
		    Submit<i class="material-icons right">send</i>
	  	</button>
	</div>
{!! Form::close() !!}