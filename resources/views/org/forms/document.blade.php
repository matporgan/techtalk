<div id="document-lightbox" class="lightbox" style="display:none;">

	{!! Form::open(['method' => 'POST', 'action' => ['DocumentsController@store', $org->id], 'files' => true, 'id' => 'document-form']) !!}

		<h2 class="center">Add Document</h2><br />

		<div class="file-field input-field">
			<div class="btn">
				<i class="material-icons left">attach_file</i>
				<span>Upload*</span>
				<input type="file" name="file">
			</div>
			<div class="file-path-wrapper">
				<input class="file-path validate" type="text">
			</div>
		</div>
		
		<div class="input-field">
			{!! Form::text('name', null) !!}
			{!! Form::label('name', 'Name*') !!}
		</div>
		
		<div class="input-field">
			{!! Form::textarea('description', null, ['class' => 'materialize-textarea']) !!}
			{!! Form::label('description', 'Description*') !!}
		</div><br />
		
		<div class="row center">
			<button class="btn waves-effect waves-light" type="submit" name="action">
			    Add Document
		  	</button>
		</div>

	{!! Form::close() !!}

</div>