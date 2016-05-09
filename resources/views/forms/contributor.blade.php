@include('forms.js-lightbox')

<div id="contributor-lightbox" class="lightbox" style="display:none;">
	{!! Form::open(['method' => 'POST', 'action' => ['ContributorsController@store', $org->id], 'id' => 'contributor-form']) !!}
		<h2 class="center">Add Contributor</h2>
	
		<div class="input-field">
			{!! Form::label('email', 'Email:') !!}
			{!! Form::text('email', null, ['class' => 'form-control']) !!}
		</div>
		<p><i>Note: The user should have already registered with the above email.</i></p><br />

		
		<div class="row center">
			<button class="btn-large waves-effect waves-light" type="submit" name="action">
			    Add Contributor<i class="material-icons left">add</i>
		  	</button>
		</div>
	{!! Form::close() !!}
</div>

<script type="text/javascript">
	$("#contributor-form").validate({
		rules: {
			email: {
				required: true,
				email: true
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