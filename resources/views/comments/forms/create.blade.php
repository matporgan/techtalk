{!! Form::open(['method' => 'POST', 'action' => ['CommentsController@store', $discussion->id, 0], 'class' => 'col s12', 'id' => 'comment-form']) !!}
    <div class="input-field">
		{!! Form::label('body', $comment_prompt, ['class' => 'active']) !!}
		{!! Form::textarea('body', null, ['class' => 'materialize-textarea mention']) !!}
	</div>

	<div class="row right">
		<button class="btn waves-effect waves-light" type="submit" name="action">
		    Submit<i class="material-icons right">send</i>
	  	</button>
	</div>
{!! Form::close() !!}

<script type="text/javascript">

</script>