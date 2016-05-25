<div class="discussion-board">
	@if($discussions->count() != 0)
		<table class="highlight">
			<tbody>
				@foreach($discussions as $discussion)
					<tr>
						<td>
							<div>
								@if($discussion->type == 'Organisation')
									<i class="material-icons left discussion-icon">business</i>
									<a href="orgs/{{ $discussion->org_id }}#discussion" class="collection-item discussion-name">
										Organisation: {{ $discussion->name }}
									</a>
								@elseif($discussion->type == 'Discussion')
									<i class="material-icons left discussion-icon">forum</i>
									<a href="discussions/{{ $discussion->id }}" class="collection-item discussion-name">
										Discussion: {{ $discussion->name }}
									</a>
								@elseif($discussion->type == 'Question')
									<i class="material-icons left discussion-icon">live_help</i>
									<a href="discussions/{{ $discussion->id }}" class="collection-item discussion-name">
										Question: {{ $discussion->name }}
									</a>
								@endif
							</div>
							<div>
								@if($discussion->comments()->count() == 0)
									Created <div id="time-{{ $discussion->id }}" class="discussion-date">{{ $discussion->created_at.' UTC' }}</div>
									by <div class="discussion-user">{{ $discussion->user->getNameAndCity() }}</div>
								@else
									Updated <div id="time-{{ $discussion->id }}" class="discussion-date">{{ $discussion->comments()->orderBy('id', 'desc')->first()->created_at.' UTC' }}</div>
									by <div class="discussion-user">{{ $discussion->comments()->orderBy('id', 'desc')->first()->user->getNameAndCity() }}</div>
								@endif
							</div>
						</td>
						<td class="center">
							{{ $discussion->comments()->count() }}
						</td>
					</tr>

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
			</tbody>
		</table>
	@else
		<div class="center">
			<h2>You have no discussions...</h2>
		</div>
	@endif
</div>

@if($discussions->lastPage() > 1)
	<div class="row center">
		<ul class="pagination">
			@if($discussions->lastPage() == 1)
				<li class="disabled"><i class="material-icons">chevron_left</i></li>
				<li class="active"><a href="{{ $discussions->currentPage() }}">1</a></li>
				<li class="disabled"><i class="material-icons">chevron_right</i></li>
			@else
				<li class=@if($discussions->currentPage() == 1)"disabled"@endif>
					<a href="{{ $discussions->previousPageUrl() }}"><i class="material-icons">chevron_left</i></a>
				</li>
				@for($i = 1; $i <= $discussions->lastPage(); $i++)
					<li class=@if($discussions->currentPage() == $i)"active"@else"waves-effect"@endif>
						<a href="{{ $discussions->url($i) }}">{{ $i }}</a>
					</li>
				@endfor
				<li class=@if($discussions->currentPage() == $discussions->lastPage())"disabled"@endif>
					<a href="{{ $discussions->nextPageUrl() }}"><i class="material-icons">chevron_right</i></a>
				</li>
			@endif
		</ul>
	</div>
@endif