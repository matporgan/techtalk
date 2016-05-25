<div id="contributor-modal" class="modal modal-form">
    <div class="modal-content">

		{!! Form::open(['method' => 'POST', 'action' => ['ContributorsController@store', $org->id], 'id' => 'contributor-form']) !!}

			<h2 class="center">Add Contributor</h2>
		
			<div class="input-field">
				{!! Form::label('email', 'Email*') !!}
				{!! Form::text('email', null, ['class' => 'form-control']) !!}
			</div>
			<p><i>Note: The contributor must have registered with the above email</i></p><br />

			
			<div class="row center">
				<button class="btn waves-effect waves-light" type="submit" name="action">
				    Add Contributor
			  	</button>
			</div>

		{!! Form::close() !!}

	</div>
</div>