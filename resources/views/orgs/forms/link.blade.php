<div id="link-lightbox" class="lightbox" style="display:none;">

	{!! Form::open(['method' => 'POST', 'action' => ['LinksController@store', $org->id], 'id' => 'link-form']) !!}

		<h2 class="center">Add Link</h2><br />

		<div class="input-field">
			{!! Form::label('url', 'URL*') !!}
			{!! Form::text('url', null) !!}
		</div>
		
		<div class="input-field">
			{!! Form::label('description', 'Description*', ['class' => 'active']) !!}
			{!! Form::textarea('description', null, ['class' => 'materialize-textarea']) !!}
		</div><br />
		
		<div class="row center">
			<button class="btn waves-effect waves-light" type="submit" name="action">
			    Add Link
		  	</button>
		</div>

	{!! Form::close() !!}

</div>