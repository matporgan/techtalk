@extends('layouts.app')

@section('content')

<div class="row" style="height: 90vh">
	<div class="row">
		<div class="col s12">
			<div class="center" style="font-size: 30px; margin-top: 20px">
				<h1 class="center">Tech Talk</h1>
				A place to 
				<br /><a href="#!" class="btn-large">find</a>, <a href="#!" class="btn-large">discuss</a> and <a href="#!" class="btn-large">contribute</a>
				<br />information about the tech world.
			</div>
		</div>
	</div>
</div>
	
<div class="row">
	<div class="row">
		<div class="col s12">
			<div id="thecube-wrapper" style="width:100%; height:360px;">
				@include('snippets.cube')
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col s12 m6 offset-m3">
			<div id="search-box" class="input-field search-box">
				<input name="search" id="search" type="search" @if(isset($query))value="{{ $query }}"@endif>
				<label for="search" class="active"><i class="material-icons prefix">search</i></label>
			</div>
	
			<button id="search-btn" class="btn waves-effect waves-light z-depth-2" type="submit" name="action" style="display: none;">
				Search
			</button>
		</div>
	</div>
</div>

<div class="row" style="position: relative; z-index: 10;"> 
	<div class="col s12">
		<h2>Latest Organisations</h2>
	</div>
	
	@foreach ($latest_orgs as $org)
		<div class="col s12 m6 l3">
			<a href="/orgs/{{ $org->id }}">
				<div class="card hoverable">
					<div class="card-image">
						<img src="{{ $org->logo }}">
					</div>
					<div class="card-content">
						<p><b>{{ $org->name }}</b></p>
					</div>
				</div>
			</a>
		</div>
	@endforeach
</div>

<div class="row"> 
	<div class="col s12 m4 l4">
	    <h2>Stats</h2>
	    <table class="stats striped z-depth-1">
	    	<tbody>
		    	@foreach ($stats as $category => $stat)
		        	<tr>
		    			<td>{{ $category }}</td>
		    			<td>{{ $stat }}</td>
		    		</tr>
		        @endforeach
	    	</tbody>
	    </table>
	</div>
	
	<div class="col s12 m4 l4">
	    <h2>Top Contributors</h2>
    	<table class="stats striped z-depth-1">
	    	<tbody>
		    	<?php $i = 1; ?>
		    	@foreach ($top_contributors as $user)
		        	<tr>
		        		<td>{{ $i . "." }}</td>
		    			<td>{{ $user->getNameAndCity() }}</td>
		    			<td>{{ $user->org_count }}</td>
		    		</tr>
		    		<?php $i++; ?>
		        @endforeach
	    	</tbody>
        </table>
	</div>
	
	<div class="col s12 m4 l4">
	    <h2>Top Commentors</h2>
        <table class="stats striped z-depth-1">
	    	<tbody>
		    	<?php $i = 1; ?>
		    	@foreach ($top_commentors as $user)
		        	<tr>
		        		<td>{{ $i . "." }}</td>
		    			<td>{{ $user->getNameAndCity() }}</td>
		    			<td>{{ $user->comment_count }}</td>
		    		</tr>
		    		<?php $i++; ?>
		        @endforeach
	    	</tbody>
        </table>
	</div>
</div>

<div id="cube-technologies" class="modal bottom-sheet">
	<a class="alink modal-close"><i class="material-icons icon-close">keyboard_arrow_down</i></a>

	<div class="modal-content container">
		<h2>Technologies</h2>
		<table>
			<tr>
				<td>
					<h3>Emerging</h3>
					<ul>
						@foreach($categories['technologies']['emerging'] as $technology)
							<li>
								@if($technology->orgs()->first() != null)
									<a href="/technology/{{ $technology->id }}">
										{{ $technology->name }}
									</a>
								@else
									{{ $technology->name }}
								@endif
							</li>
						@endforeach
					</ul>
				</td>
				<td>
					<h3>Stable</h3>
					<ul>
						@foreach($categories['technologies']['stable'] as $technology)
							<li>
								@if($technology->orgs()->first() != null)
									<a href="/technology/{{ $technology->id }}">
										{{ $technology->name }}
									</a>
								@else
									{{ $technology->name }}
								@endif
							</li>
						@endforeach
					</ul>
				</td>
				<td>
					<h3>Accelerating</h3>
					<ul>
						@foreach($categories['technologies']['accelerating'] as $technology)
							<li>
								@if($technology->orgs()->first() != null)
									<a href="/technology/{{ $technology->id }}">
										{{ $technology->name }}
									</a>
								@else
									{{ $technology->name }}
								@endif
							</li>
						@endforeach
					</ul>
				</td>
			</tr>
		</table>
	</div>
</div>

<div id="cube-industries" class="modal bottom-sheet">
	<a class="alink modal-close"><i class="material-icons icon-close">keyboard_arrow_down</i></a>

	<div class="modal-content container">
		<h2>Industries</h2>
		<ul>
			@foreach($categories['industries'] as $industry)
				<li>
					@if($industry->orgs()->first() != null)
						<a href="/industry/{{ $industry->id }}">
							{{ $industry->name }}
						</a>
					@else
						{{ $industry->name }}
					@endif
				</li>
			@endforeach
		</ul>
	</div>
</div>

<div id="cube-domains" class="modal bottom-sheet">
	<a class="alink modal-close"><i class="material-icons icon-close">keyboard_arrow_down</i></a>

	<div class="modal-content container">
		<h2>Domains</h2>
		<table>
			<tr>
				@foreach($categories['domains'] as $chunk)
				<td>
					@foreach($chunk as $domains)
						<h3>{{ $domains->first()->industry->name }}</h3>
						<ul>
							@foreach($domains as $domain)
								<li>
									@if($domain->orgs()->first() != null)
										<a href="/domain/{{ $domain->id }}">
											{{ $domain->name }}
										</a>
									@else
										{{ $domain->name }}
									@endif
								</li>
							@endforeach
						</ul>
					@endforeach
				</td>
				@endforeach
			</tr>
		</table>
	</div>
</div>

<script type="text/javascript">
	$('#close-cube-technologies').click(function() {
		$('#cube-technologies').closeModal();	
	});
	
	$('#close-cube-industries').click(function() {
		$('#cube-industries').closeModal();	
	});
	
	$('#close-cube-domains').click(function() {
		$('#cube-domains').closeModal();	
	});    
</script>

@stop