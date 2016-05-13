@if($orgs->count() != 0)

	<div class="row org-grid">
		<div class="col s12">
			<div class="grid">
				
				<div class="grid-sizer"></div>
				<div class="grid-gutter-sizer"></div>
				
				@foreach ($orgs as $org)
					<a href="/orgs/{{ $org->id }}">
						<div class="card grid-item">
							<div class="card-image">
								<img src="{{ $org->logo }}">
							</div>
							<div class="card-content">
								<p><b>{{ $org->name }}</b></p>
								<p>{{ $org->short_desc }}</p>
							</div>
						</div>
					</a>
				@endforeach
				
			</div>
		</div>
	</div>
	
@else

	<h2>No Orgs...</h2>
	
@endif
		
<div class="row center">
	<ul class="pagination">
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
	</ul>
</div>

<script type="text/javascript">
	$('#filters-link').click(function(){
		if ($('#filters').is(':visible')) {
			show('filters', false);
			document.querySelector('#filters-icon').innerHTML = 'add';
		}
		else {
			show('filters', true);
			document.querySelector('#filters-icon').innerHTML = 'remove';
		}
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