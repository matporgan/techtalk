@extends('layouts.app')

@section('content')

<div class="row" hidden>
    <div style="width:100%; height:380px; margin-top: 30px; border:2px solid #00ade3;">@include('snippets.cube')</div>
</div>

<div class="row" hidden>
	<div class="col s3">
		<h2>Technologies</h2>
	</div>
	<div class="col s3">
		<h3>Emerging</h3>
		<p>
			Technology 1<br />
			Technology 2<br />
		</p>
	</div>
</div>

<div class="row">
    <div style="width:100%; height:380px; margin-top: 30px; border:2px solid #00ade3;">Graphic to go here</div>
</div>

<div class="row"> 
    
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

	<div class="col s12 m4">
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
	
	<div class="col s12 m4">
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
	
	<div class="col s12 m4">
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

@stop