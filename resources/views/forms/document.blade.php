@include('forms.js-lightbox')

<div id="document_form" class="lightbox" style="display:none;">
	{!! Form::open(['method' => 'POST', 'action' => ['DocumentsController@store', $org->id], 'files' => true]) !!}
		<h2>Add Document</h2>
		<div class="input-field">
			{!! Form::label('upload', 'Upload:') !!}
			{!! Form::file('upload', ['id' => 'upload']) !!}
		</div>
		
		<div class="input-field">
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name', null, ['id' => 'filename', 'class' => 'form-control']) !!}
		</div>
		
		<div class="input-field">
			{!! Form::label('description', 'Description:') !!}
			{!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2']) !!}
		</div>
		
		<div class="input-field">
			{!! Form::submit('Add Document', ['class' => 'btn btn-primary']) !!}
		</div>
	{!! Form::close() !!}
</div>

<script type="text/javascript">
	// Auto-populates the document name field
	$('#upload').change(function() {
	    var filename = $(this).val();
	    var lastIndex = filename.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        filename = filename.substring(lastIndex + 1);
	    }
	    $('#filename').val(filename.replace(/\.[^/.]+$/, ""));
	});
</script>