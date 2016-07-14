<div class="card-panel org-header">
	<div class="row header-btn-wrapper">
		<div class="col s12">
			<h1 class="advisian-blue-text">{!! $org->name !!}</h1>
		</div>
		<div class="header-btn">
			<div class="btn-group">
				@can('update-org', $org)
					<a href="{{ $org->id }}/edit" class="btn green"><i class="material-icons">edit</i></a>
					<a onclick="deleteConfirmation()" class="btn red"><i class="material-icons">close</i></a>
				@endcan
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<p>{!! nl2br($org->short_desc) !!}</p>
	    	<p class="linkify">{!! nl2br($org->long_desc) !!}</p>
	    </div>
	</div>

{{-- 	@if($org->users->where('id', Auth::user()->id)->first()->pivot->watcher)
		<a href="{{ $org->id }}/watch" class="btn unwatch"><i class="material-icons left">visibility</i>Watch</a>
	@else
		<a href="{{ $org->id }}/watch" class="btn-flat watch"><i class="material-icons left">visibility</i>Watch</a>
	@endif
	
	<script type="text/javascript">
		$('.unwatch').hover(function() {
			$(this)
				.removeClass('btn')
				.addClass('btn-flat')
				.html('<i class="material-icons left">visibility_off</i>Watch');
		}, function() {
			$(this)
				.addClass('btn')
				.removeClass('btn-flat')
				.html('<i class="material-icons left">visibility</i>Watch');
		});
	</script> --}}
</div>