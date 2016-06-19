<div id="popup-search">
	{!! Form::open(['method' => 'POST', 'action' => ['SearchController@' . $type], 'id' => 'popup-search-form']) !!}
		<div id="search-box" class="input-field search-box card">
			<input name="search" id="search" type="search" placeholder="@if($type=='discussions')Search discussions...@elseif($type=='orgs')Search...@endif" @if(isset($query))value="{{ $query }}"@endif>
			<label for="search"><i class="material-icons prefix">search</i></label>
		</div>

		<button type="submit" name="action" style="display: none;"></button>

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
				
				@if(Auth::check() && Auth::user()->isAdmin())
					<br /><h3 class="center">Restricted</h3><br />
					
					<div class="input-field">
						{!! Form::select('partner_status', [
							''=>'', 
							'No Partnership'=>'No Partnership', 
							'In Development'=>'In Development', 
							'Active Partner'=>'Active Partner', 
							'Past Partner'=>'Past Partner',
						], null, ['id' => 'partner_status']) !!}
						{!! Form::label('partner_status', 'Partner Status*') !!}
					</div>
			
					<div class="input-field">
						{!! Form::select('in_talks', [
							''=>'', 
							'No'=>'No', 
							'Yes'=>'Yes'
						], null, ['id' => 'in_talks']) !!}
						{!! Form::label('in_talks', 'In Talks*') !!}
					</div>
				@endif
				
				<a id="clear-btn" class="btn waves-effect waves-light right">Clear</a>
			</div>
		</div>
	{!! Form::close() !!}

	<a id="browse-all" href="@if($type=='discussions') /discuss @else /discover @endif" class="search-subtitle alink">Browse All</a>
	@if ($type == 'orgs')
		<a id="advanced-search" class="search-subtitle alink">Advanced Search</a>
	@endif
</div>

<script type="text/javascript">
	var parts = window.location.search.substr(1).split("&");
	var $_GET = {};
	for (var i = 0; i < parts.length; i++) {
	    var temp = parts[i].split("=");
	    $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
	}

	if ($_GET['s'] == 'basic')  {
		basicSearch();
	}
	else if ($_GET['s'] == 'advanced') {
		advancedSearch();
	}

	function basicSearch() {
		$('#search-filter').openModal({complete: function() { 
			$('.search-subtitle').removeClass('white-text');
			$('#popup-search').css('z-index', 0);
			$('#advanced-search').toggle();
		 	// $('#search-box').hide();
		 	// $('#advanced-search').hide();
		 	// $('#browse-all').hide();
		 	// $('#search-filter').hide();
		}});
		// $('#search-box').fadeIn();
		// $('#advanced-search').fadeIn();
		// $('#browse-all').fadeIn();
		$('#search').focus();
		$('.search-subtitle').addClass('white-text');
		$('#advanced-search').toggle();
		$('#popup-search').css('z-index', 1009);
	}

	function advancedSearch() {
		basicSearch();
		$('#search-filter').attr("style", "z-index: 1003; display: block !important; opacity: 1; transform: scaleX(1); top: 10%;");
	}

	$('#search').focusin(function() {
		$('.search-subtitle').addClass('advisian-blue-text');
	});
	$('#search').focusout(function() {
		$('.search-subtitle').removeClass('advisian-blue-text');
	});

	$('#toggle-search').click(function() {
		basicSearch();
	});

	$('#advanced-search').click(function() {
		advancedSearch();
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