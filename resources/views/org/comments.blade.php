<div class="row">
	@include('forms.comment')
</div>


@foreach($org->comments as $comment)
	<div class="row">
		<div class="comment-author">
			<span class="author-name">{{ $comment->user->name }} | </span>
			<span class="author-date"> 
				<span id="time-{{ $comment->id }}">{{ $comment->created_at.' UTC' }}</span>@if($comment->created_at != $comment->updated_at)*@endif
			</span>
		</div>
		<div class="comment-body">
			{{ $comment->body }}
		</div>
		<div class="comment-reply">
			<a id="show-{{ $comment->id }}" href="#!">Reply</a>
		</div>

		@include('forms.comment-reply', ['parent_id' => $comment->id])

		<script type="text/javascript">
			$('#show-{{ $comment->id }}').click(function() {
				show('#reply-form-{{ $comment->id }}', true);
			});

			var commentTime = $('#time-{{ $comment->id }}');

			// convert to local time string
			var dateObject = new Date(commentTime.text())
			var localeDate = dateObject.toLocaleString(); 

			// make pretty
			var prettyDate = moment(localeDate).fromNow();

			// replace time text
			commentTime.text(prettyDate);
		</script>
	</div>
@endforeach
