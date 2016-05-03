<div id="document_form" class="lightbox" style="display:none;">
	{!! Form::open(['method' => 'POST', 'action' => ['DocumentsController@store', $org->id], 'files' => true]) !!}
		<h2>Add Document</h2>
		<div class="form-group">
			{!! Form::label('upload', 'Upload:') !!}
			{!! Form::file('upload', ['id' => 'upload']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name', null, ['id' => 'filename', 'class' => 'form-control']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::label('description', 'Description:') !!}
			{!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::submit('Add Document', ['class' => 'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
</div>

@include('documents._form-js')