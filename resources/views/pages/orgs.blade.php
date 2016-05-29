@extends('layouts.app')

@section('content')

<div class="row">

	<div class="col s12">

		<div class="row">
			<h1 class="center">Organisations</h1>
		</div>

		<div class="row">
			<div class="col s12 m6 offset-m3">
				{!! Form::open(['method' => 'POST', 'action' => ['SearchController@search'], 'id' => 'search-form']) !!}
					<div style="height: 40px;">
						<div id="search-box" class="input-field search-box">
							<input name="search" id="search" type="search" @if(isset($query))value="{{ $query }}"@endif>
							<label for="search" class="active"><i class="material-icons prefix">search</i></label>
						</div>
						
						<!--<div>-->
						<!--	<a class="btn right waves-effect waves-light" href="#!">Search</a>-->
						<!--</div>-->
						
						<a id="filter-btn" class="btn waves-effect waves-light z-depth-2" style="display: none;">
					    	<i class="material-icons icon">filter_list</i>
						</a>
						<button id="search-btn" class="btn waves-effect waves-light z-depth-2" type="submit" name="action" style="display: none;">
					    	Search
						</button>
						<div class="lean-overlay" id="materialize-lean-overlay-4" style="z-index: 1002; display: none; opacity: 0.5;"></div>
					</div>
					
					<div id="search-filter" class="modal modal-left">
						<div class="modal-content">
							<h2 class="center">Filter</h2><br />
							
							<div class="input-field">
								<select name="technology_list[]" id="technology_list" multiple>
									<option value="" disabled selected>Select...</option>
									@foreach($categories['technologies'] as $id => $technology)
										<option value="{{ $technology }}">{{ $technology }}</option>
									@endforeach
								</select>
								{!! Form::label('technology_list', 'Technologies') !!}
							</div>
							
							<div class="input-field">
								<select name="industry_list[]" id="industry_list" multiple>
									<option value="" disabled selected>Select...</option>
									@foreach($categories['industries'] as $id => $industry)
										<option value="{{ $industry }}">{{ $industry }}</option>
									@endforeach
								</select>
								{!! Form::label('industry_list', 'Industries') !!}
							</div>
							
							<div class="input-field">
								<select name="domain_list[]" id="domain_list" multiple>
									<option value="" disabled selected>Select...</option>
									<option>Planning</option>
									<option>Development</option>
									<option>Distribution</option>
									<option>Retail</option>
								</select>
								{!! Form::label('domain_list', 'Domains') !!}
							</div>
							
							@if(Auth::user()->isAdmin())
								<br /><h3 class="center">Restricted</h3><br />
								
								<div class="input-field">
									{!! Form::select('partner_status', [
										''=>'', 
										'No Partnership'=>'No Partnership', 
										'In Development'=>'In Development', 
										'Active Partner'=>'Active Partner', 
										'Past Partner'=>'Past Partner',
									], null) !!}
									{!! Form::label('partner_status', 'Partner Status*') !!}
								</div>
						
								<div class="input-field">
									{!! Form::select('in_talks', [
										''=>'', 
										'No'=>'No', 
										'Yes'=>'Yes'
									], null) !!}
									{!! Form::label('in_talks', 'In Talks*') !!}
								</div>
							@endif
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
		
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
		//$('.search-menu').sideNav('show');
		$('#search-box').addClass('z-depth-2');
		$('#search-btn').show();
		//$('#filter-btn').show();
		//$('#materialize-lean-overlay-4').show();
		$('#search-filter').openModal({complete: function() { 
		 	$('#search-box').removeClass('z-depth-2');
			$('#search-btn').hide();
			$('#filter-btn').hide();
			//$('#materialize-lean-overlay-4').hide();
		}});
	});
	
	$('#filter-btn').click(function() {
		
	})
	
	$('#search').focusout(function() {
		// $('#search-filter').closeModal();
		// $('#search-box').removeClass('z-depth-2');
		// $('#search-btn').removeClass('z-depth-2');
		// $('#search-btn').toggle();
	});
</script>

@stop