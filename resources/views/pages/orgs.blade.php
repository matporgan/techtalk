@extends('layouts.app')

@section('content')

<div class="row">

	<div class="col s12">

		<div class="row">
			<h1 class="center">Organisations</h1>
		</div>

		<div class="row">
			<div class="col m3 hide-on-small-only" style="margin-top:40px;">
				<a id="grid-toggle" class="alink"><i class="material-icons icon-large">view_comfy</i></a>
				<a id="list-toggle" class="alink inactive"><i class="material-icons icon-large">view_list</i></a>
			</div>
			
			<div class="col s12 m6">
				{!! Form::open(['method' => 'POST', 'action' => ['SearchController@search'], 'id' => 'search-form']) !!}
					<div class="input-field">
						<input name="search" type="search" @if(isset($query))value="{{ $query }}"@endif>
						<label for="search" class="active"><i class="material-icons prefix">search</i></label>
					</div>
				{!! Form::close() !!}
			</div>
			
			<div class="col s12 m3" style="margin-top:30px;">
				<a class="btn right waves-effect waves-light" href="orgs/create">Add</a>
			</div>
		</div>
		
		<div class="row">
			<form>
				<div class="input-field col s12 m3">
					{!! Form::select('partner_status', [0=>'', 1=>'No Partnership', 2=>'In Development', 3=>'Active Partner', 4=>'Past Partner'], null) !!}
					{!! Form::label('partner_status', 'Partner Status*') !!}<br />
				</div>
				<div class="input-field col s12 m3">
					{!! Form::select('partner_status', [0=>'', 1=>'No Partnership', 2=>'In Development', 3=>'Active Partner', 4=>'Past Partner'], null) !!}
					{!! Form::label('partner_status', 'Partner Status*') !!}<br />
				</div>
				<div class="input-field col s12 m3">
					{!! Form::select('partner_status', [0=>'', 1=>'No Partnership', 2=>'In Development', 3=>'Active Partner', 4=>'Past Partner'], null) !!}
					{!! Form::label('partner_status', 'Partner Status*') !!}<br />
				</div>
				<div class="input-field col s12 m3">
					{!! Form::select('partner_status', [0=>'', 1=>'No Partnership', 2=>'In Development', 3=>'Active Partner', 4=>'Past Partner'], null) !!}
					{!! Form::label('partner_status', 'Partner Status*') !!}<br />
				</div>
			</form>
		</div>
		
		@include('orgs._grid')

	</div> <!-- END col -->

</div> <!-- END row -->

<!--<nav>-->
<!--	<ul id="slide-out" class="side-nav">-->
<!--		<li><a href="#!">First Sidebar Link</a></li>-->
<!--		<li><a href="#!">Second Sidebar Link</a></li>-->
<!--	</ul>-->
<!--	<a href="#" data-activates="slide-out" class="button-collapse search-menu show-on-large"><i class="mdi-navigation-menu"></i></a>-->
<!--</nav>-->

<script type="text/javascript">
	/* grid-list toggle */
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
	
	/* search functions */
	$('#search').focus(function() {
		 $('.search-menu').sideNav('show');
	});
</script>

@stop