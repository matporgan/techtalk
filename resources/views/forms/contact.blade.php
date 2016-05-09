@include('forms.js-lightbox')

<div id="contact-lightbox" class="lightbox" style="display:none;">
	{!! Form::open(['method' => 'POST', 'action' => ['ContactsController@store', $org->id], 'id' => 'contact-form']) !!}
		<h2 class="center">Add Contact</h2><br />

		<div class="input-field">
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name', null) !!}
		</div>
		
		<div class="input-field">
			{!! Form::label('email', 'Email:') !!}
			{!! Form::text('email', null) !!}
		</div><br />
		
		<div class="row center">
			<button class="btn-large waves-effect waves-light" type="submit" name="action">
			    Add Contact<i class="material-icons left">add</i>
		  	</button>
		</div>
	{!! Form::close() !!}
</div>

<script type="text/javascript">
	$("#contact-form").validate({
		rules: {
			name: "required",
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