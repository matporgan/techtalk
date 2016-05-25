@extends('layouts.app')

@section('content')

<div class="row">

	<div class="col s12">

		<div class="row">
			<h1 class="center">My Organisations</h1>
		</div>

		<div class="row">
			<div class="col m3 hide-on-small-only" style="margin-top:40px;">
				<a id="grid-toggle" class="alink"><i class="material-icons icon-large">view_comfy</i></a>
				<a id="list-toggle" class="alink inactive"><i class="material-icons icon-large">view_list</i></a>
			</div>
			
			<div class="col s12 m6">
			<form>
				<div class="input-field">
					<input id="search" type="search">
					<label for="search"><i class="material-icons prefix">search</i></label>
				</div>
			</form>
			</div>
			
			<div class="col s12 m3" style="margin-top:30px;">
				<a class="btn right waves-effect waves-light" href="orgs/create">Add</a>
			</div>
		</div>
		
		@include('orgs._grid')

	</div> <!-- END col -->

</div> <!-- END row -->

<script type="text/javascript">
	$('#list-toggle').click( function() {
		$('#grid-toggle').addClass('inactive');
		$('#list-toggle').removeClass('inactive');
		$('.grid').addClass('list');
		grid.masonry('layout');
	});
	
	$('#grid-toggle').click( function() {
		$('#list-toggle').addClass('inactive');
		$('#grid-toggle').removeClass('inactive');
		$('.grid').removeClass('list');
		grid.masonry('layout');
	});
</script>

@stop