@extends('layouts.app')

@section('content')

@if($discussion->org_id != null)
	<script type="text/javascript">
	    window.location = "/orgs/{{ $discussion->org_id }}#discussion";//here double curly bracket
	</script>
@endif

<div class="row">
	<h1 class="center">{{ $discussion->type }}</h1>
</div>

<div class="row">

	<div class="col s12 m10 l8 offset-m1 offset-l2">

		<div class="row">
			<div class="col s12">
				<div class="card-panel advisian-blue white-text">
					<h2>{{ $discussion->name }}</h2>
					<p>{!! $discussion->prompt !!}</p>
					<div>
						Created <span id="discussion-time" class="advisian-charcoal-text">{{ $discussion->created_at.' UTC' }}</span>
						by <span class="advisian-charcoal-text">{{ $discussion->user->name }}</span> 
					</div>
				</div>
			</div>
		</div>

		@include('comments._index', ['comment_prompt' => 'Reply to '.$discussion->user->name])

	</div>

</div>

<script type="text/javascript">
	var commentTime = $('#discussion-time');

	// convert to local time string
	var localTime = moment.utc(commentTime.text()).local();

	// make pretty
	var prettyDate = localTime.fromNow();

	// replace time text
	commentTime.text(prettyDate);
</script>

@stop