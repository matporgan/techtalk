@extends('layout')

@section('content')
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
@stop