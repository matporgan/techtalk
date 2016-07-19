@extends('layouts.app')

@section('content')

<div class="container">

@if($discussion->org_id != null)
	<script type="text/javascript">
	    window.location = "/orgs/{{ $discussion->org_id }}#discussion"; 
	</script>
@endif

<div class="row">
	<div class="col s12">
		<h1 class="center">{{ $discussion->type }}</h1>
	</div>
</div>

<div class="row">

	<div class="col s12 m10 l8 offset-m1 offset-l2">

		<div class="row">
			<div class="col s12">
				<div class="card-panel">
					<h2 class="advisian-blue-text">{{ $discussion->name }}</h2>
					<p class="linkify">{!! $discussion->prompt !!}</p>
					<div>
						Created <span id="discussion-time" class="advisian-gold-text">{{ $discussion->created_at.' UTC' }}</span>
						by <span class="advisian-gold-text">{{ $discussion->user->getNameAndCity() }}</span> 
					</div>
				</div>
			</div>
		</div>

		@include('comments._index', ['comment_prompt' => 'Reply to '.$discussion->user->getNameAndCity()])

	</div>

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