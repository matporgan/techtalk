<div class="row" style="margin-top:20px;">
	<img src="{{ $org->logo }}" alt="{{ $org->name . " - Logo" }}" class="logo responsive-img" />
</div>

<div class="row">
	<p class="linkify">{{ $org->website }}</p>
</div>

<div class="row">
	<h3>Technologies</h3>
	@foreach($org->technologies as $technology)
		<a href="/technology/{{ $technology->id }}">
			<div class="chip">{{ $technology->name }}</div>
		</a>
	@endforeach
</div>

<div class="row">
	<h3>Industries</h3>
	@foreach($org->industries as $industry)
		<a href="/industry/{{ $industry->id }}">
			<div class="chip">{{ $industry->name }}</div>
		</a>
	@endforeach
</div>

{{-- <div class="row">
	<h3>Domains</h3>
	@foreach($org->domains as $domain)
		<a href="/domain/{{ $domain->id }}">
			<div class="chip">{{ $domain->name }}</div>
		</a>
	@endforeach
</div> --}}

@if(! $org->tags->isEmpty())
	<div class="row">
		<h3>Applications</h3>
		@foreach($org->tags as $tag)
			<a href="/tag/{{ $tag->id }}">
				<div class="chip">{{ $tag->name }}</div>
			</a>
		@endforeach
	</div>
@endif

<div class="row">
	<h3>Creator</h3>
	@foreach($org->users as $user)
		@if($user->pivot->org_role == 'owner')
			<a href="mailto:{{ $user->email }}" target="_top">{{ $user->getNameAndCity() }}</a>
		@endif
	@endforeach
</div>

<div class="row">
	@if($org->users->count() == 1)
		@can('update-org', $org)
			<h3>Contributors</h3>
		@endcan
	@else
		<h3>Contributors</h3>
	@endif
	@foreach($org->users as $user)
		@if($user->pivot->org_role == 'contributor')
			<a href="mailto:{{ $user->email }}" target="_top">{{ $user->getNameAndCity() }}</a>
			@can('update-org', $org)
				 | <a href="{{ $org->id }}/contributor/{{ $user->id }}/delete" class="red-text">Delete</a><br />
			@endcan
		@endif
	@endforeach
	@can('update-org', $org)
		<a class="btn modal-trigger" href="#contributor-modal" style="margin-top: 10px;">Add</a>
	@endcan
</div>
