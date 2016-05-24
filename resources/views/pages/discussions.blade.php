@extends('layouts.app')

@section('content')

<div class="row">

	<div class="col s12">

		<div class="row">
			<h1 class="center">Discussions</h1>
		</div>
		
		<div class="row">
			<div class="col s12 m6 offset-m3">
			<form>
				<div class="input-field">
					<input id="search" type="search">
					<label for="search"><i class="material-icons prefix">search</i></label>
				</div>
			</form>
			</div>
			
			<div class="col s12 m3" style="margin-top:30px;">
				<a class="btn right waves-effect waves-light" href="discussions/create">Add</a>
			</div>
		</div>
		
		<div class="row center">
			@if(! is_null($discussions))
				<table class="discussion-board highlight">
					<thead><tr></tr></thead>
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
				<h2>No Discussions...</h2>
			@endif

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

		</div>

	</div>

</div>

@stop