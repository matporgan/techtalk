@include('forms.js-lightbox')

<div id="document_form" class="lightbox" style="display:none;">
	{!! Form::open(['method' => 'POST', 'action' => ['DocumentsController@store', $org->id], 'files' => true, 'class' => 'doc_form']) !!}
		<h2 class="center">Add Document</h2><br />
		
		<!--<div class="input-field">-->
		<!--	{!! Form::label('upload', 'Upload:') !!}-->
		<!--	{!! Form::file('upload', ['id' => 'upload']) !!}-->
		<!--</div>-->
		
		<div class="file-field input-field">
			<div class="btn">
				<i class="material-icons left">attach_file</i>
				<span>File*</span>
				<input type="file" name="file">
			</div>
			<div class="file-path-wrapper">
				<input class="file-path validate" type="text">
			</div>
		</div>
		
		<div class="input-field">
			{!! Form::text('name', null, ['validate', 'required']) !!}
			{!! Form::label('name', 'Name*', ['class' => 'active']) !!}
		</div>
		
		<div class="input-field">
			{!! Form::textarea('description', null, ['required', 'class' => 'materialize-textarea']) !!}
			{!! Form::label('description', 'Description*', ['class' => 'active']) !!}
		</div>
		
		<div class="row center">
			<button class="btn-large waves-effect waves-light" type="submit" name="action">
			    Add Document<i class="material-icons left">add</i>
		  	</button>
		</div>
	{!! Form::close() !!}
</div>

<script type="text/javascript">
	$(".doc_form").validate({
		rules: {
			name: {
				required: true
			},
			description: {
				required: true
			}
		},
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }
	});
</script>