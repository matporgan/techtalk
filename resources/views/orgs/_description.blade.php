<div class="card-panel org-header">
	<div class="row header-btn-wrapper">
		<div class="col s12">
			<h1 class="advisian-blue-text">{!! $org->name !!}</h1>
		</div>

		<div class="header-btn header-btn-org">
		{{-- <div class="btn-group" style="margin-left: 10px;"> --}}
			@can('update-org', $org)
				<a href="{{ $org->id }}/edit" class="btn green"><i class="material-icons">edit</i></a>
				<a onclick="deleteConfirmation()" class="btn red"><i class="material-icons">close</i></a>
			@endcan
		</div>

		<div class="btn-group" style="margin-left: 10px;">
		{{-- <div class="header-btn header-btn-org"> --}}
			<?php $url =  "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>
			<a href="mailto: ?subject={{ $org->name }} - Tech Talk&body=Check out this organisation... %0a%0a{{ $org->name }} - {{ $url }}" class="btn"><i class="material-icons left">send</i>Share</a>
			@if(Auth::check())
				<?php $org_user = $org->users->where('id', Auth::user()->id)->first(); ?> 
				@if($org_user != null)
					@if($org->users->where('id', Auth::user()->id)->first()->pivot->watcher)
						<a href="{{ $org->id }}/watch" class="btn unwatch"><i class="material-icons left">visibility</i>Watching</a>
					@else
						<a href="{{ $org->id }}/watch" class="btn-flat watch tooltipped" data-position="bottom" data-delay="50" data-tooltip="Get notified of discussions about this organisation."><i class="material-icons left">visibility</i>Watch</a>
					@endif
				@else
					<a href="{{ $org->id }}/watch" class="btn-flat watch tooltipped" data-position="bottom" data-delay="50" data-tooltip="Get notified of discussions about this organisation."><i class="material-icons left">visibility</i>Watch</a>
				@endif
			@else
				<a href="/login" class="btn-flat watch tooltipped" data-position="bottom" data-delay="50" data-tooltip="Get notified of discussions about this organisation."><i class="material-icons left">visibility</i>Watch</a>
			@endif
		</div>
	</div>
	<div class="row">
		<div class="col s12">
			<p>{!! nl2br($org->short_desc) !!}</p>
	    	<p class="linkify">{!! nl2br($org->long_desc) !!}</p>
	    </div>
	</div>
	
	<script type="text/javascript">
		$('.unwatch').mouseenter(function() {
			$(this)
				.removeClass('btn')
				.addClass('btn-flat')
				.html('<i class="material-icons left">visibility_off</i>Unwatch');
		});
		$('.unwatch').mouseout(function() {
			$(this)
				.addClass('btn')
				.removeClass('btn-flat')
				.html('<i class="material-icons left">visibility</i>Watching');
		});
	</script>
</div>