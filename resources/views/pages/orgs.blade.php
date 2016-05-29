@extends('layouts.app')

@section('content')

<div class="row">

	<div class="col s12">

		<div class="row">
			<h1 class="center">Organisations</h1>
		</div>

		@include('orgs._search')
		
		<div class="row" style="margin-bottom: 0;">
			<div class="col m3 hide-on-small-only" style="margin-top:40px;">
				<a id="grid-toggle" class="alink"><i class="material-icons icon-large">view_comfy</i></a>
				<a id="list-toggle" class="alink inactive"><i class="material-icons icon-large">view_list</i></a>
			</div>
			
			<div class="col s12 m3 offset-m6" style="margin-top:30px;">
				<a class="btn right waves-effect waves-light" href="orgs/create">Add</a>
			</div>
		</div>
		
		@include('orgs._grid')

	</div> <!-- END col -->

</div> <!-- END row -->

<script type="text/javascript">
	/* grid-list toggle */
	$('#list-toggle').click(function() {
		$('#grid-toggle').addClass('inactive');
		$('#list-toggle').removeClass('inactive');
		$('.grid').addClass('list');
		grid.masonry('layout');
	});
	
	$('#grid-toggle').click(function() {
		$('#list-toggle').addClass('inactive');
		$('#grid-toggle').removeClass('inactive');
		$('.grid').removeClass('list');
		grid.masonry('layout');
	});
	
	/* search functions */
	$('#search').focus(function() {
		// $('.search-menu').sideNav('show');
		$('#search-box').addClass('z-depth-2');
		$('#search-btn').show();
		// $('#filter-btn').show();
		// $('#materialize-lean-overlay-4').show();
		$('#search-filter').openModal({complete: function() { 
		 	$('#search-box').removeClass('z-depth-2');
			$('#search-btn').hide();
			$('#filter-btn').hide();
			// $('#materialize-lean-overlay-4').hide();
		}});
	});
	
	$('#clear-btn').click(function() {
		$('#technology_list').val("");
		$('#industry_list').val("");
		$('#domain_list').val("");
		$('#partner_status').val("");
		$('#in_talks').val("");
	    $('select').material_select();
  	});
</script>

@stop