@extends('layout')

@section('content')

<div class="row">
	<h1 class="center">Organisations</h1>
</div>

<div class="row">
	
</div>

<div class="row valign-wrapper">
	<div class="valign col s12 m4">
		<a href="#!" class="" id="filters-link">Filter Results<i class="material-icons" id="filters-icon">add</i></a>
	</div>
	<div class="valign col s12 m8">
		<div class="input-field col m8">
		    <input id="icon_prefix" type="text">
		    <label for="icon_prefix">Search</label>
		</div>
		<div class="input-field col m4">
			<a class="waves-effect waves-light btn icon right"><i class="material-icons right">search</i>Search</a>
		</div>
	</div>
</div>
<div class="row" id="filters" style="display:none;">
	<div class="input-field col s12 m3">
		<select multiple>
			<option value="" disabled selected>Select...</option>
			<option value="1">Option 1</option>
			<option value="2">Option 2</option>
			<option value="3">Option 3</option>
		</select>
		<label>Technologies</label>
	</div>
	<div class="input-field col s12 m3">
		<select multiple>
			<option value="" disabled selected>Select...</option>
			<option value="1">Option 1</option>
			<option value="2">Option 2</option>
			<option value="3">Option 3</option>
		</select>
		<label>Industries</label>
	</div>
	<div class="input-field col s12 m3">
		<select multiple>
			<option value="" disabled selected>Select...</option>
			<option value="1">Option 1</option>
			<option value="2">Option 2</option>
			<option value="3">Option 3</option>
		</select>
		<label>Domains</label>
	</div>
	<div class="switch">
		<label>
			Not in Talks
			<input type="checkbox">
			<span class="lever"></span>
			In Talks
		</label>
	</div>
</div>

<div class="row">
	@foreach ($orgs as $org)
			<div class="col s12 m4">
				<a href="/orgs/{{ $org->id }}">
					<div class="card">
						<div class="card-image">
							<img src="{{ $org->logo }}">
						</div>
						<div class="card-content">
							<p><b>{{ $org->name }}</b></p>
							<p>{{ $org->short_desc }}</p>
						</div>
					</div>
				</a>
			</div>
	@endforeach
</div>

<script type="text/javascript">
	$('#filters-link').click(function(){
		if ($('#filters').is(':visible')) {
			$('#filters').css('display', 'none');
			document.querySelector('#filters-icon').innerHTML = 'add';
		}
		else {
			$('#filters').css('display', 'block');
			document.querySelector('#filters-icon').innerHTML = 'remove';
		}
	});
</script>

@stop