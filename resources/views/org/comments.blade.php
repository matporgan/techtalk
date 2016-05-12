<div class="row comment-box-wrapper">
	@include('forms.comment')

	@unless(Auth::check())
		<div class="comment-overlay center">	
			<div class="btn-group">
				<a class="btn-large waves-effect waves-light" href="/login">Login to Comment</a>
			  	<a href="/register">Register</a>
			</div>
	  	</div>
	@endunless
</div>

@unless($comments == null)
	@foreach($comments as $comment)
		<div class="row">
			<div class="col s12 m{{ 12 - ($comment->getLevel() >= 3 ? 3 : $comment->getLevel()) }} offset-m{{ ($comment->getLevel() >= 3 ? 3 : $comment->getLevel()) }}">
				<div class="comment-header">
					<span class="author-name">{{ $comment->user->name }} | </span>
					<span class="author-date" id="time-{{ $comment->id }}">{{ $comment->created_at.' UTC' }}</span>@if($comment->created_at != $comment->updated_at)*@endif
					<div class="reply-details">
						@if($comment->getLevel() > 0)
							<span class="reply-icon"><i class="material-icons left" style="font-size: 20px;">reply</i></span>
							<span class="reply-author">{{ $comment->getParentName() }}</span>
						@endif
					</div>
				</div>
				<div class="comment-body" id="comment-body-{{ $comment->id }}">
					<div class="comment-text">
						{{ $comment->body }}
					</div>
					<div class="comment-actions">
						@can('update-comment', $comment)
							@if($comment->body != "(Comment Deleted)")
								<a id="edit-{{ $comment->id }}" href="#!">Edit</a> | <a href="/comment/{{ $comment->id }}/delete" class="red-text">Delete</a>
							@endif
						@else 
							@if(Auth::check())
								<a id="reply-{{ $comment->id }}" href="#!">Reply</a>
							@else
								<a href="/register">Reply</a>
							@endif
						@endcan
					</div>
				</div>
			
				<div class="comment-action" id="comment-action-{{ $comment->id }}">
					@can('update-comment', $comment)
						<div id="edit-form-{{ $comment->id }}" style="display:none;">
							<div>
								@include('forms.comment-edit', ['parent_id' => $comment->id])
							</div>
						</div>
					@else
						<div id="reply-form-{{ $comment->id }}" style="display:none;">
							<div class="col s11 offset-s1">
								@include('forms.comment-reply', ['parent_id' => $comment->id])
							</div>
						</div>
					@endcan
				</div>
			</div>
		</div>

		<script type="text/javascript">
			$(document).ready(function(){
			    $("#edit-{{ $comment->id }}").click(function(){
			        $("#edit-form-{{ $comment->id }}").slideToggle();
			        $("#comment-body-{{ $comment->id }}").slideToggle();
			        $("#edit-{{ $comment->id }}").toggleClass("advisian-gold-text");
			    });
			    $("#cancel-edit-{{ $comment->id }}").click(function(){
			        $("#edit-form-{{ $comment->id }}").slideToggle();
			        $("#comment-body-{{ $comment->id }}").slideToggle();
			        $("#edit-{{ $comment->id }}").toggleClass("advisian-gold-text");
			    });
			    $("#reply-{{ $comment->id }}").click(function(){
			        $("#reply-form-{{ $comment->id }}").slideToggle();
			        $("#textarea-{{ $comment->id }}").focus();
			        $("#reply-{{ $comment->id }}").toggleClass("advisian-gold-text");
			    });
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

	@endforeach
@endunless

<!-- Form Validation -->
<script type="text/javascript">
	$("#comment-form").validate({
		rules: {
			body: "required",
		},
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
	});

	$("#comment-edit-form").validate({
		rules: {
			body: "required",
		},
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
	});

	$("#comment-reply-form").validate({
		rules: {
			body: "required",
		},
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
	});
</script>