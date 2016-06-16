@extends('layouts.app')

@section('content')

<div class="container">

<div class="row">
	<div class="col s12">
		<h1 class="center"><span>#</span>Discover</h1>
	</div>

	<div class="col s12 m8 l6 offset-m2 offset-l3">
		@include('orgs._search')
		<div class="space"></div>
		<div class="space"></div>
	</div>

	<div class="col s12">
		@if(isset($query) && $query != "")
			<h3>{{ $orgs->total() }} @if($orgs->total() == 1) result @else results @endif found for:&nbsp;</h3>
			<h2>{{ $query }}</h2>
		@else
			<h3>{{ $orgs->total() }} @if($orgs->total() == 1) result @else results @endif</h3>
		@endif
		<div class="divider"></div>
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
</script>

@stop