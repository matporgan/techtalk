@extends('layouts.app')

@section('content')

<div class="row">
	<h1 class="center">Discussion</h1>
</div>

<div class="row">

	<div class="col s12">

		<div class="row">
			<form>
				<div class="col s12 m6 l6 offset-l3">
					<div class="input-field">
						<i class="material-icons prefix">search</i>
						<input id="search" type="search" required>
						<label for="search"></label>
					</div>
				</div>
			</form>
			
			<div class="col right">
				<a class="btn-large waves-effect waves-light" href="discussions/create">
					<i class="material-icons left">add</i>New Topic
			  	</a>
			</div>
		</div>

		<div class="row center">
			@if(! is_null($discussions))
				<table class="discussion-board bordered">
					<thead><tr></tr></thead>
					<tbody>
						@foreach($discussions as $discussion)
							<tr><td>
								<div>
									<div>
										@if($discussion->type == 'Organisation')
											<i class="material-icons left" style="font-size:2.3rem;">business</i>
											<a href="orgs/{{ $discussion->org_id }}#discussion" class="collection-item">
												Organisation: {{ $discussion->name }}
											</a>
										@elseif($discussion->type == 'Discussion')
											<i class="material-icons left" style="font-size:2.3rem;">forum</i>
											<a href="discussions/{{ $discussion->id }}" class="collection-item">
												Discussion: {{ $discussion->name }}
											</a>
										@elseif($discussion->type == 'Question')
											<i class="material-icons left" style="font-size:2.3rem;">live_help</i>
											<a href="discussions/{{ $discussion->id }}" class="collection-item">
												Question: {{ $discussion->name }}
											</a>
										@endif
									</div>
									<div>
										@if($discussion->comments()->count() == 0)
											Created <span id="time-{{ $discussion->id }}">{{ $discussion->created_at.' UTC' }}</span>
											by <span>{{ $discussion->user->name }}</span>
										@else
											Updated <span id="time-{{ $discussion->id }}">{{ $discussion->comments()->orderBy('id', 'desc')->first()->created_at.' UTC' }}</span>
											by <span>{{ $discussion->comments()->orderBy('id', 'desc')->first()->user->name }}</span>
										@endif
									</div>
								</div>
							</td>
							<td width="70px" class="center">
								<h2>{{ $discussion->comments()->count() }}</h2>
							</td></tr>

							<script type="text/javascript">
								var commentTime = $('#time-{{ $discussion->id }}');

								// convert to local time string
								var dateObject = new Date(commentTime.text())
								var localeDate = dateObject.toLocaleString(); 

								// make pretty
								var prettyDate = moment(localeDate).fromNow();

								// replace time text
								commentTime.text(prettyDate);
							</script>
						@endforeach
					</tbody>
				</table>
			@else
				<h2>No Discussions...</h2>
			@endif
		</div>

	</div>

</div>

@stop