{!! Form::open(['method' => 'POST', 'action' => ['CommentsController@store', $discussion->id, $parent_id], 'class' => 'col s12', 'id' => 'comment-reply-form']) !!}
    <div class="input-field">
		{!! Form::label('body', "Reply to ".$comment->user->getNameAndCity(), ['class' => 'active']) !!}
		{!! Form::textarea('body', null, ['class' => 'materialize-textarea', 'id' => 'textarea-'.$comment->id]) !!}
	</div>

	<div class="row btn-group">
		<a class="btn waves-effect waves-light right" id="cancel-reply-{{ $comment->id }}">
		    Cancel
	  	</a>
		<button class="btn waves-effect waves-light right" type="submit" name="action">
		    Submit<i class="material-icons right">send</i>
	  	</button>
	</div>
{!! Form::close() !!}