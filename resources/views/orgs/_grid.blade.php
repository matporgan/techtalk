<div class="row org-grid">
	@if($orgs->count() != 0)

		<div class="col s12">
			<div class="grid">
				
				<div class="grid-sizer"></div>
				<div class="grid-gutter-sizer"></div>
				
				@foreach ($orgs as $org)
					<a href="/orgs/{{ $org->id }}">
						<div class="card grid-item hoverable">
							<div class="card-image">
								<img src="{{ $org->logo }}">
							</div>
							<div class="card-content">
								<div class="org-name">{{ $org->name }}</div>
								<div class="org-desc">{{ $org->short_desc }}</div>
							</div>
						</div>
					</a>
				@endforeach
				
			</div>
		</div>

	
	@else
		<div class="center" style="margin-top: 50px;">
			<h2>Nothing Found.</h2>
		</div>
	@endif
</div>
	
@if(method_exists($orgs, 'lastPage') && $orgs->lastPage() > 1)	
	<div class="row center">
		<ul class="pagination">
			@if($orgs->lastPage() == 1)
				<li class="disabled"><i class="material-icons">chevron_left</i></li>
				<li class="active"><a href="{{ $orgs->currentPage() }}">1</a></li>
				<li class="disabled"><i class="material-icons">chevron_right</i></li>
			@else
				<li class=@if($orgs->currentPage() == 1)"disabled"@endif>
					<a href="{{ $orgs->previousPageUrl() }}"><i class="material-icons">chevron_left</i></a>
				</li>
				@for($i = 1; $i <= $orgs->lastPage(); $i++)
					<li class=@if($orgs->currentPage() == $i)"active"@else"waves-effect"@endif>
						<a href="{{ $orgs->url($i) }}">{{ $i }}</a>
					</li>
				@endfor
				<li class=@if($orgs->currentPage() == $orgs->lastPage())"disabled"@endif>
					<a href="{{ $orgs->nextPageUrl() }}"><i class="material-icons">chevron_right</i></a>
				</li>
			@endif
		</ul>
	</div>
@endif

<script type="text/javascript">
	onReady(function () {
	    grid.masonry('layout');
	});

	var grid = $('.grid').masonry({
		percentPosition: true,
		columnWidth: '.grid-sizer',
		itemSelector: '.grid-item',
		gutter: '.grid-gutter-sizer',
	});

	grid.imagesLoaded().progress( function() {
		grid.masonry('layout');
	});
</script>