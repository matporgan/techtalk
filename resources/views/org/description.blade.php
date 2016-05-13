<div class="card-panel advisian-blue white-text" style="padding: 0px 40px 5px 30px;">
	<div class="row">
		<div class="col">
			<h1>{!! $org->name !!}</h1>
			Created by 
			@foreach($org->users as $user)
				@if($user->pivot->org_role == 'owner')
					<a href="mailto:{{ $user->email }}" class="white-text">{{ $user->name }}</a>
				@endif
			@endforeach
		</div>
	</div>
</div>
<div class="card-panel" style="padding: 10px 40px 5px 40px;">
	<div class="row">
		<h2>Description</h2>

		<p>{!! nl2br($org->short_desc) !!}</p>

    	<p>{!! nl2br($org->long_desc) !!}</p>
	</div>
</div>