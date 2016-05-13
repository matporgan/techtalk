<div class="grid">
	<div class="grid-sizer">
		<div class="grid-gutter-sizer">
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