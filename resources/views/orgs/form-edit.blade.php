{{ Form::model($org, array('route' => array('orgs.edit', $org->id))) }}

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

<div class="form-group">
	{!! Form::label('technologies', 'Technologies:') !!}
	{!! Form::select('technologies[]', $technologies, null, ['class' => 'form-control', 'multiple']) !!}
</div> 

<div class="form-group">
	{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
</div>


<!-- {{ method_field('PATCH') }}
{{ csrf_field() }}

<div class="form-group">
	<label for="name">Name:</label>
	<input type="text" name="name" id="name" class="form-control" value="{{ $org->name }}" required>
</div>

<div class="form-group">
	<label for="logo">Logo:</label>
	<input type="text" name="logo" id="logo" class="form-control" value="{{ $org->logo }}" required>
</div>

<div class="form-group">
	<label for="short_desc">Short Description (160 characters):</label>
	<textarea type="text" name="short_desc" id="short_desc" class="form-control" rows="3" required>{{ $org->short_desc }}</textarea>
</div>

<div class="form-group">
	<label for="long_desc">Long Description:</label>
	<textarea type="text" name="long_desc" id="long_desc" class="form-control" rows="6">{{ $org->long_desc }}</textarea>
</div>

<div class="form-group">
	<label for="website">Website:</label>
	<input type="text" name="website" id="website" class="form-control" value="{{ $org->website }}" required>
</div>

<div class="form-group">
	<button type="submit" class="btn btn-primary pull-right">Save</button> 
</div> -->