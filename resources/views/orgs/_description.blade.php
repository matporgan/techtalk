<div class="card-panel org-header advisian-blue white-text">
	<div class="row header-btn-wrapper">
		<div class="col">
			<h1>{!! $org->name !!}</h1>
			Created by 
			@foreach($org->users as $user)
				@if($user->pivot->org_role == 'owner')
					<a href="mailto:{{ $user->email }}" class="white-text">{{ $user->getNameAndCity() }}</a>
				@endif
			@endforeach
		</div>
		<div class="header-btn">
			<div class="btn-group">
				@can('update-org', $org)
					<a href="{{ $org->id }}/edit" class="btn green"><i class="material-icons">edit</i></a>
					<a onclick="deleteConfirmation()" class="btn red"><i class="material-icons">close</i></a>
				@endcan
			</div>
		</div>
	</div>
</div>
<div class="card-panel org-body">
	<div class="row">
		<h2>Description</h2>

		<p>{!! nl2br($org->short_desc) !!}</p>

    	<p>{!! nl2br($org->long_desc) !!}</p>
	</div>
</div>