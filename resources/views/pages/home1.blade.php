@extends('layouts.app')

@section('content')

<div id="landing" class="section">
	<div class="content center">
		<h1 class="landing-header center">
			<div class="site-logo">
				<span>&lt;</span><span id="typed"></span><span>&gt;</span>
			</div>
		</h1>
		
		<div class="landing-message">
			<a id="to-find" class="alink btn-large">
				<i class="material-icons left">search</i>find
			</a>, 
			<a id="to-discuss" class="btn-large">
				<i class="material-icons left">forum</i>discuss
			</a> and 
			<a id="to-contribute" class="btn-large">
				<i class="material-icons left">add</i>contribute
			</a>
			<br />information about the tech world.
		</div>
	</div>

	<div id="to-down" class="section-down alink">
		<i class="material-icons icon-large">keyboard_arrow_down</i>
	</div>
</div>
	
<div id="find" class="section">
	<div class="container">
		<h1><span>#</span>find</h1>
		<div class="hide-on-med-and-up" style="height: 50px;"></div>
		
		<div class="row">
			<div class="col s12 m7">
				<div id="thecube-wrapper">
					@include('snippets.cube')
				</div>
			</div>
			
			<div class="col s12 m5">
				<div class="content">
					<i class="material-icons browse-icon">keyboard_arrow_left</i>
					browse<br />
					or<br />
					search
					<i class="material-icons search-icon">keyboard_arrow_down</i>
				</div>
				
				<div id="search-box" class="input-field search-box">
					<input name="search" id="search" type="search" @if(isset($query))value="{{ $query }}"@endif>
					<label for="search" class="active"><i class="material-icons prefix">search</i></label>
				</div>
				
				<button id="search-btn" class="btn waves-effect waves-light z-depth-2" type="submit" name="action" style="display: none;">
					Search
				</button>
			</div>
		</div>
		
		<div class="row" style="position: relative; z-index: 10; margin-bottom: 0;">
			<div class="col s12">
				<h2>contributions->latest(4)</h2>
				
				<a href="/orgs/create" class="btn waves-effect waves-light right">add</a>
			</div>
		</div>
		
		<div class="divider"></div>
		
		<row>
			@include('orgs._grid')
		</row>
		
		<div class="row valign-wrapper" style="position: relative; z-index: 10;">
			<div class="col s1 valign">
				<div class="">
					<a href="/orgs" class="btn-floating btn-large waves-effect waves-light tooltipped" data-tooltip="see more" data-position="top" data-delay="50">
						<i class="material-icons search-icon">keyboard_arrow_right</i>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="discuss" class="section">
	<div class="container">
		<h1><span>#</span>discuss</h1>
		
		<div class="row" style="position: relative; z-index: 10; margin-bottom: 0;">
			<div class="col s12">
				<h2>discussions->latest(4)</h2>
			</div>
		</div>
		
		<div class="divider"></div>
		
		@include('discussions._board')
	</div>
</div>

<div id="contribute" class="section last">
	<div class="container">
		<h1><span>#</span>contribute</h1>

		
		
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
</div>

<script type="text/javascript">
	// section scrolls
	var navHeight = 60;
	$('#to-down').click(function() {
		$('html,body').animate({scrollTop:$('#find').offset().top - navHeight},'slow');
	});
	$('#to-find').click(function() {
		$('html,body').animate({scrollTop:$('#find').offset().top - navHeight},'slow');
	});
	$('#to-discuss').click(function() {
		$('html,body').animate({scrollTop:$('#discuss').offset().top - navHeight},'slow');
	});
	$('#to-contribute').click(function() {
		$('html,body').animate({scrollTop:$('#contribute').offset().top - navHeight},'slow');
	});
	
	// scroll show/hide logo
	$(window).scroll(function() {
		if ($(this).scrollTop() > $(".landing-header").offset().top + 10) {
			$('.brand-logo').fadeIn();
			$('nav').css('box-shadow', '0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12)');
		}
		else {
			$('.brand-logo').fadeOut();
			$('nav').css('box-shadow', 'none');
		}
	});
	
	// typed.js logo
	$(window).load(function() {
		$("#typed").typed({
			strings: ["tech ^300 talk"],
			typeSpeed: 150
		});
	});
	
	// close modals
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