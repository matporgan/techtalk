<div class="divider"></div>

<div class="discussion-board">
	@if($discussions->count() != 0)
		@foreach($discussions as $discussion)
			@if($discussion->type == 'Organisation')
				<a href="/orgs/{{ $discussion->org_id }}#discussion">
			@else
				<a href="/discussions/{{ $discussion->id }}">
			@endif
				<div class="card-panel hoverable">
					@if($discussion->type == 'Organisation')
						<i class="material-icons left discussion-icon">business</i>
					@elseif($discussion->type == 'Discussion')
						<i class="material-icons left discussion-icon">forum</i>
					@elseif($discussion->type == 'Question')
						<i class="material-icons left discussion-icon">live_help</i>
					@endif
					<div class="discussion">
						<div class="discussion-name">
							@if($discussion->type == 'Organisation')
								Organisation: {{ $discussion->name }}
							@elseif($discussion->type == 'Discussion')
								Discussion: {{ $discussion->name }}
							@elseif($discussion->type == 'Question')
								Question: {{ $discussion->name }}
							@endif
						</div>
						<div class="discussion-details">
							@if($discussion->comments()->count() == 0)
								Created <div id="time-{{ $discussion->id }}" class="discussion-date">{{ $discussion->created_at.' UTC' }}</div>
								by <div class="discussion-user">{{ $discussion->user->getNameAndCity() }}</div>
							@else
								Updated <div id="time-{{ $discussion->id }}" class="discussion-date">{{ $discussion->comments()->orderBy('id', 'desc')->first()->created_at.' UTC' }}</div>
								by <div class="discussion-user">{{ $discussion->comments()->orderBy('id', 'desc')->first()->user->getNameAndCity() }}</div>
							@endif
						</div>
					</div>
					<div class="discussion-count right hide-on-small-only">
						{{ $discussion->comments()->count() }}
					</div>
				</div>
			</a>
			<script type="text/javascript">
				var commentTime = $('#time-{{ $discussion->id }}');

				// convert to local time string
				var localTime = moment.utc(commentTime.text()).local();

				// make pretty
				var prettyDate = localTime.fromNow();

				// replace time text
				commentTime.text(prettyDate);
			</script>
		@endforeach
	@else
		<div class="center">
			<h2>Nothing Found.</h2>
		</div>
	@endif
</div>

<?php
	if (isset($_GET['search']))
	{
		$search = '&search=' . $_GET['search'];
	}
	else 
	{
		$search = "";
	}
?>
@if(method_exists($discussions, 'lastPage') && $discussions->lastPage() > 1)
	<div class="divider"></div>
	<div class="row center">
		<ul class="pagination">
			@if($discussions->lastPage() == 1)
				<li class="disabled"><i class="material-icons">chevron_left</i></li>
				<li class="active"><a href="{{ $discussions->currentPage() . $search }}">1</a></li>
				<li class="disabled"><i class="material-icons">chevron_right</i></li>
			@else
				<li class=@if($discussions->currentPage() == 1)"disabled"@endif>
					<a href="{{ $discussions->previousPageUrl() . $search }}"><i class="material-icons">chevron_left</i></a>
				</li>
				@for($i = 1; $i <= $discussions->lastPage(); $i++)
					<li class=@if($discussions->currentPage() == $i)"active"@else"waves-effect"@endif>
						<a href="{{ $discussions->url($i) . $search }}">{{ $i }}</a>
					</li>
				@endfor
				<li class=@if($discussions->currentPage() == $discussions->lastPage())"disabled"@endif>
					<a href="{{ $discussions->nextPageUrl() . $search }}"><i class="material-icons">chevron_right</i></a>
				</li>
			@endif
		</ul>
	</div>
@endif