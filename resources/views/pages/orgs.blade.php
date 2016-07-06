@extends('layouts.app')

@section('content')

<div class="container">

<div class="row">
	<div class="col s12">
		<h1 class="title center"><i class="material-icons">search</i>Discover</h1>
	</div>

	<div class="col s12 m8 l6 offset-m2 offset-l3">
		@include('orgs._search', ['type' => 'orgs'])
		<div class="space"></div>
		<div class="space"></div>
	</div>
	<div class="col s12 m2 l3">
		<div style="position:relative;">
			<a href="/orgs/create" class="btn-floating btn-large advisian-blue" style="position: absolute; display: inline-block; right: 0; top: 15px;">
				<i class="large material-icons">add</i>
			</a>
		</div>
	</div>

	<div class="col s12">
		@if(isset($query) && $query != "")
			<h3>{{ $orgs->total() }} @if($orgs->total() == 1) organisation @else organisations @endif found for:&nbsp;</h3>
			<h2>{{ $query }}</h2>
		@elseif(isset($category) && $category != "")
			<h3>{{ $orgs->total() }} @if($orgs->total() == 1) organisation @else organisations @endif found for the <b>{{ $type }}:&nbsp;</b></h3>
			<h2>{{ $category }}</h2>
		@else
			<h3>{{ $orgs->total() }} @if($orgs->total() == 1) organisation @else organisations @endif</h3>
		@endif
	</div>

	<div class="col s12">
		<div class="right">
			<a id="grid-toggle" class="alink"><i class="material-icons icon-large">view_comfy</i></a>
			<a id="list-toggle" class="alink inactive"><i class="material-icons icon-large">view_list</i></a>
		</div>
	</div>

	<div class="col s12">
		@include('orgs._grid')
	</div> <!-- END col -->
</div> <!-- END row -->

</div>



<script type="text/javascript">
	var $_GET = getQuery();
	if ($_GET['layout'] == 'list') {
		listView();
		$('.page').each(function() {
			$(this).attr("href", $(this).attr("href") + '&layout=list');
		});
	}
	else {
		gridView();
		$('.page').each(function() {
			$(this).attr("href", $(this).attr("href") + '&layout=grid');
		});
	}

	/* grid-list toggle */
	$('#list-toggle').click(function() {
		listView();
		$('.page').each(function() {
			$(this).attr("href", $(this).attr("href").replace('grid', 'list'));
		});
	});

	$('#grid-toggle').click(function() {
		gridView();
		$('.page').each(function() {
			$(this).attr("href", $(this).attr("href").replace('list', 'grid'));
		});
	});

	function listView() {
		$('#grid-toggle').addClass('inactive');
		$('#list-toggle').removeClass('inactive');
		$('.grid').addClass('list');
		grid.masonry('layout');
	}

	function gridView() {
		$('#list-toggle').addClass('inactive');
		$('#grid-toggle').removeClass('inactive');
		$('.grid').removeClass('list');
		grid.masonry('layout');
	}
</script>

@stop
