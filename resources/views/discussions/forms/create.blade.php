<div class="row">
	<div class="input-field">
		{!! Form::label('name', 'Topic Title *', ['id' => 'name', 'class' => 'active']) !!}
		{!! Form::text('name', null) !!}
	</div>
</div>

<div class="row">
	<div class="input-field">
		{!! Form::label('type', 'Type *', ['class' => 'active']) !!}
		{!! Form::select('type', [0=>'Discussion', 1=>'Question'], null) !!}
	</div>
</div>

<div class="row">
	<div class="input-field">
		{!! Form::label('prompt', 'Body *', ['class' => 'active']) !!}
		{!! Form::textarea('prompt', null, ['class' => 'materialize-textarea']) !!}
	</div>
</div>

<div class="row center">
	<button class="btn-large waves-effect waves-light" type="submit" name="action">
	    Submit<i class="material-icons right">send</i>
  	</button>
</div>

<script type="text/javascript">

	$("#discussion-create").validate({
		rules: {
			name: "required",
			prompt: "required",
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