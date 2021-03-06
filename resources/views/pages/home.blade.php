@extends('layouts.app')

@section('content')

<div id="landing" class="section">
	<div class="card center z-depth-2">
		<h1 class="landing-header center">
			<div class="site-logo">
				<span>&lt;</span><span id="typed"></span><span>&gt;</span>
			</div>
			<div class="beta">BETA</div>
			<div id="landing-subtitle">discover, discuss, connect</div>
		</h1>

		<div class="landing-search">
			{!! Form::open(['method' => 'POST', 'action' => ['SearchController@orgs'], 'id' => 'search-form']) !!}
				<div id="home-search-box" class="input-field search-box">
					<input name="search" id="home-search" type="search" placeholder="Artificial Intelligence, BrainChip, ...">
					<label for="search"><i class="material-icons prefix">search</i></label>
				</div>
			{!! Form::close() !!}

			{{-- <a href="discover?s=advanced" class="alink">Advanced Search</a> --}}
		</div>

		<div class="landing-browse">
			<div>or</div>
			<div id="down-1" class="btn-large white advisian-charcoal-text">Browse</div>
		</div>
	</div>

	<div id="down-2" class="landing-down alink bounce animated">
		<i class="material-icons icon-large">keyboard_arrow_down</i>
	</div>
</div>

<div class="parallax-container">
	<div class="parallax"><img src="img/nodes.jpg"></div>
</div>

<div id="discover" class="section">
	<div class="container">
		<div class="row" style="position: relative; z-index: 10; margin-bottom: 0;">
			<div class="header-btn-wrapper">
				<h1><i class="material-icons">search</i>Discover</h1>
			</div>
		</div>

		<div class="row">
			@include('snippets.cube')
		</div>
	</div>
</div>

<div class="parallax-container">
	<div class="parallax"><img src="img/nodes.jpg"></div>
</div>

<div id="activity" class="section">
	<div class="container">
		<div class="row" style="position: relative; z-index: 10; margin-bottom: 0;">
			<div class="header-btn-wrapper">
				<h1><i class="material-icons">update</i>Activity</h1>
			</div>
		</div>

		<div class="row" style="position: relative; z-index: 10; margin-bottom: 0;">
			<div class="header-btn-wrapper">
				<h2>Newest Tech</h2>
				<a href="/discover" class="btn-large header-btn waves-effect waves-light right"><i class="material-icons left">search</i>All</a>
			</div>
		</div>

		<div class="row">
			@include('orgs._grid')
		</div>

		<div class="row" style="position: relative; z-index: 10; margin-bottom: 0;">
			<div class="header-btn-wrapper">
				<h2>Latest Discussion</h2>
				<a href="/discuss" class="btn-large header-btn waves-effect waves-light right"><i class="material-icons left">forum</i>All</a>
			</div>
		</div>

		<div class="row">
			@include('discussions._board')
		</div>
	</div>
</div>

<div class="parallax-container">
	<div class="parallax"><img src="img/nodes.jpg"></div>
</div>

<div id="activity" class="section">
	<div class="container">
		<div class="row" style="position: relative; z-index: 10; margin-bottom: 0;">
			<div class="header-btn-wrapper">
				<h1><i class="material-icons">multiline_chart</i>Numbers</h1>
			</div>
		</div>

		<div class="row">
			<div class="col s12 m4 l4">
			    <h3>Stats</h3>
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
			    <h3>Top Contributors</h3>
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
			    <h3>Top Commentors</h3>
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
	</div>
</div>

<div class="parallax-container">
	<div class="parallax"><img src="img/nodes.jpg"></div>
</div>

<script type="text/javascript">
	onReady(function () {
	    $("#typed").typed({
			strings: ["tech ^300 talk"],
			startDelay: 500,
			typeSpeed: 50,
			callback: function() {
				$('.typed-cursor').hide();
				$('.beta').fadeIn();
			}
		});
		$('#home-search').focus();
	});

	// section scrolls
	var navHeight = 60;
	$('#down-1').click(function() {
		$('html,body').animate({scrollTop:$('#discover').offset().top - navHeight},'slow');
	});
	$('#down-2').click(function() {
		$('html,body').animate({scrollTop:$('#discover').offset().top - navHeight},'slow');
	});

	$('#toggle-search').click(function() {
		$('html,body').animate({scrollTop:0},'slow');
		$('#home-search').focus();
	});
</script>

@stop
