@include('forms.js-lightbox')

<div id="link-lightbox" class="lightbox" style="display:none;">
	{!! Form::open(['method' => 'POST', 'action' => ['LinksController@store', $org->id], 'id' => 'link-form']) !!}
		<h2 class="center">Add Link</h2><br />

		<div class="input-field">
			{!! Form::label('url', 'URL*') !!}
			{!! Form::text('url', null) !!}
		</div>
		
		<div class="input-field">
			{!! Form::textarea('description', null, ['class' => 'materialize-textarea']) !!}
			{!! Form::label('description', 'Description*', ['class' => 'active']) !!}
		</div><br />
		
		<div class="row center">
			<button class="btn-large waves-effect waves-light" type="submit" name="action">
			    Add Link<i class="material-icons left">add</i>
		  	</button>
		</div>
	{!! Form::close() !!}
</div>

<script type="text/javascript">
	$("#link-form").validate({
		rules: {
			url: "required",
			description: "required",
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