<div class="col-md-6">
	<div class="form-group">
		{!! Form::label('name', 'Name:') !!}
		{!! Form::text('name', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('logo', 'Logo:') !!}
		{!! Form::text('logo', null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('short_desc', 'Short Description:') !!}
		{!! Form::textarea('short_desc', null, ['class' => 'form-control', 'rows' => '3', 'required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('long_desc', 'Long Description:') !!}
		{!! Form::textarea('long_desc', null, ['class' => 'form-control', 'rows' => '6', '']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('website', 'Website:') !!}
		{!! Form::text('website', null, ['class' => 'form-control', 'required']) !!}
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		{!! Form::label('technology_list', 'Technologies:') !!}
		{!! Form::select('technology_list[]', $categories['technologies'], null, ['id' => 'technology_list', 'class' => 'form-control', 'multiple']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('industry_list', 'Industries:') !!}
		{!! Form::select('industry_list[]', $categories['industries'], null, ['id' => 'industry_list', 'class' => 'form-control', 'multiple']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('cycle_list', 'Cycles:') !!}
		{!! Form::select('cycle_list[]', $categories['cycles'], null, ['id' => 'cycle_list', 'class' => 'form-control', 'multiple']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('phase_list', 'Phases:') !!}
		{!! Form::select('phase_list[]', $categories['phases'], null, ['id' => 'phase_list', 'class' => 'form-control', 'multiple']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('tag_list', 'Tags:') !!}
		{!! Form::select('tag_list[]', $categories['tags'], null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
	</div>
</div>

<div class="col-md-12">
	<hr>
	
	<div class="form-group">
		{!! Form::submit($submitText, ['class' => 'btn btn-primary']) !!}
	</div>
</div>

<script type="text/javascript">
	$('#technology_list').select2({ placeholder: 'Select all applicable' });
	$('#industry_list').select2({ placeholder: 'Select all applicable' });
	$('#cycle_list').select2({ placeholder: 'Select all applicable' });
	$('#phase_list').select2({ placeholder: 'Select all applicable' });
	$('#tag_list').select2({ 
		placeholder: 'Select all applicable, or add your own', 
		tags: true,
		tokenSeparators: [',', ';'],
		minimumInputLength: 1,
    });

    $eventSelect
</script>