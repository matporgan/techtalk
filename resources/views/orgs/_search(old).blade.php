<div class="row">
	<div class="col s12 m6 offset-m3">
		{!! Form::open(['method' => 'POST', 'action' => ['SearchController@search'], 'id' => 'search-form']) !!}
			<div style="height: 40px;">
				<div id="search-box" class="input-field">
					<input name="search" id="search" type="search" @if(isset($query))value="{{ $query }}"@endif>
					<label for="search" class="active"><i class="material-icons prefix">search</i></label>
				</div>
				
				<a id="filter-btn" class="btn waves-effect waves-light z-depth-2" style="display: none;">
					<i class="material-icons icon">filter_list</i>
				</a>
				
				<button id="search-btn" class="btn waves-effect waves-light z-depth-2" type="submit" name="action" style="display: none;">
					Search
				</button>
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
					
					<br />
					<a id="clear-btn" class="btn waves-effect waves-light right">Clear</a>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>

<script type="text/javascript">
	$('#search').focus(function() {
		$('#search-box').addClass('z-depth-2');
		$('#search-box').addClass('search-box');
		$('#search-btn').show();
		$('#search-filter').openModal({complete: function() { 
		 	$('#search-box').removeClass('z-depth-2');
		 	$('#search-box').removeClass('search-box');
			$('#search-btn').hide();
			$('#filter-btn').hide();
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