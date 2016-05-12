{!! Form::open(['method' => 'POST', 'action' => ['CommentsController@update', $comment->id], 'class' => 'col s12', 'id' => 'comment-edit-form']) !!}
    <div class="input-field">
		{!! Form::textarea('body', $comment->body, ['class' => 'materialize-textarea', 'id' => 'textarea-'.$comment->id]) !!}
		{!! Form::label('body', "Edit Comment", ['class' => 'active']) !!}
	</div>

	<div class="row btn-group">
		<a class="btn waves-effect waves-light right" id="cancel-edit-{{ $comment->id }}">
		    Cancel
	  	</a>
		<button class="btn waves-effect waves-light right" type="submit" name="action">
		    Update<i class="material-icons right">sync</i>
	  	</button>
	</div>
{!! Form::close() !!}