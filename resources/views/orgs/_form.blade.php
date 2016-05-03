@include('errors.flash')
<div class="col-md-6">
	<div class="form-group">
		{!! Form::label('name', 'Name:') !!}
		{!! Form::text('name', null, ['class' => 'form-control']) !!}
	</div>

	@if($type == 'create')
		<div class="form-group">
			{!! Form::label('logo', 'Logo:') !!}
			{!! Form::file('logo', ['id' => 'logo']) !!}
		</div>
	@else
		<div class="form-group" id="cur_logo">
			{!! Form::label('logo', 'Logo:') !!}<br />
			<img src="{{ $org->logo }}" alt="{{ $org->name . " - Logo" }}" class="logo" />
			<a class="btn" id="edit_logo" href="#">Edit</a>
		</div>

		<div class="form-group" id="new_logo" style="display:none;">
			{!! Form::label('logo', 'Logo:') !!}
			{!! Form::file('logo', ['id' => 'logo']) !!}
		</div>
		
		<script type="text/javascript">
			$("a#edit_logo").click(function(){
				document.getElementById("new_logo").style.display='block';
				document.getElementById("cur_logo").style.display='none';
			});
		</script>
	@endif

	<div class="form-group">
		{!! Form::label('short_desc', 'Short Description:') !!}
		{!! Form::textarea('short_desc', null, ['class' => 'form-control', 'rows' => '3']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('long_desc', 'Long Description:') !!}
		{!! Form::textarea('long_desc', null, ['class' => 'form-control', 'rows' => '6', '']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('website', 'Website:') !!}
		{!! Form::text('website', null, ['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('partner_status', 'Partner Status:') !!}
		{!! Form::select('partner_status', ['No Partnership','In Development','Active Partner','Past Partner'], null, ['class' => 'form-control']) !!}
	</div>
	<div class="form-group">
		{!! Form::label('in_talks', 'In Talks?:') !!}
		{!! Form::hidden('in_talks', 0) !!}
		{!! Form::checkbox('in_talks', 1) !!}
	</div>
</div>

<div class="col-md-6">
	<div class="form-group">
		{!! Form::label('tag_list', 'Tags:') !!}
		{!! Form::select('tag_list[]', $categories['tags'], null, ['class' => 'form-control tag_list', 'multiple']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('technology_list', 'Technologies:') !!}
		{!! Form::select('technology_list[]', $categories['technologies'], null, ['class' => 'form-control technology_list', 'multiple']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('industry_list', 'Industries:') !!}
		{!! Form::select('industry_list[]', $categories['industries'], null, ['class' => 'form-control industry_list', 'multiple']) !!}
	</div>

	@for ($i = 1; $i <= count($categories['industries']); $i++)
		<div class="form-group form-indent" id="{{ 'domain_list_'.$i }}">
			{!! Form::label('domain_list_'.$i, $categories['industries'][$i].' Domains:') !!}
			{!! Form::select('domain_list[]', $categories['domains'][$i], null, ['id' => 'domain_list_sel_'.$i, 'class' => 'form-control domain_list', 'multiple']) !!}
		</div>
	@endfor


</div>

<div class="col-md-12">
	<hr>
	
	<div class="form-group">
		{!! Form::submit($submitText, ['class' => 'btn btn-primary']) !!}
	</div>
</div>

@include('orgs._form-js')