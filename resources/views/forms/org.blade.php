@include('errors.flash')
<div class="row">
	<h4 class="center">General Information</h4><br />

	<div class="input-field">
		{!! Form::text('name', null, ['class' => 'validate']) !!}
		{!! Form::label('name', 'Name*', ['class' => 'active']) !!}
	</div>

	<div class="input-field">
		{!! Form::text('website', null, ['class' => 'validate']) !!}
		{!! Form::label('website', 'Website*', ['class' => 'active']) !!}
	</div>
	
	<div class="input-field">
		{!! Form::textarea('short_desc', null, ['class' => 'materialize-textarea', 'length' => '160']) !!}
		{!! Form::label('short_desc', 'Short Description*', ['class' => 'active']) !!}
	</div>

	<div class="input-field">
		{!! Form::textarea('long_desc', null, ['class' => 'materialize-textarea']) !!}
		{!! Form::label('long_desc', 'Long Description', ['class' => 'active']) !!}
	</div>

	@if($type == 'create')
		<div class="file-field input-field">
			<div class="btn">
				<i class="material-icons left">attach_file</i>
				<span>Logo*</span>
				<input type="file" name="logo">
			</div>
			<div class="file-path-wrapper">
				<input class="file-path validate" type="text">
			</div>
		</div><br />
	@elseif($type == 'edit')
		<div class="valign-wrapper" id="cur_logo">
			<a class="btn valign" id="edit_logo">Change Logo<i class="material-icons left">clear</i></a>
			<img style="margin-top: 1rem;" src="{{ $org->logo }}" alt="{{ $org->name . " - Logo" }}" class="logo valign" />
		</div>
	
		<div class="file-field input-field" id="new_logo" style="display:none;">
			<div class="btn">
				<i class="material-icons left">attach_file</i>
				<span>Logo*</span>
				<input type="file" name="logo">
			</div>
			<div class="file-path-wrapper">
				<input class="file-path validate" type="text">
			</div>
		</div><br />
	@endif
</div>

<div class="row">
	<h4 class="center">Categorization</h4><br />

	<!-- <div class="input-field">
		{!! Form::label('tag_list', 'Tags') !!}
		{!! Form::select('tag_list[]', $categories['tags'], null, ['class' => 'tag_list', 'multiple']) !!}
	</div> -->

	<div class="input-field">
		<!--{!! Form::select('technology_list[]', $categories['technologies'], null, ['multiple', 'placeholder' => 'Choose your options']) !!}-->
		<select name="technology_list[]" multiple>
			<option value="" disabled selected>Select technologies...</option>
			@foreach($categories['technologies'] as $id => $technology)
				<option value="{{ $id }}" @if($type == 'edit') {{ in_array($id, $selections['technologies']) ? 'selected' : '' }} @endif>{{ $technology }}</option>
			@endforeach
		</select>
		{!! Form::label('technology_list', 'Technologies*') !!}<br />
	</div>
	
	<div class="input-field">
		<!--{!! Form::select('industry_list[]', $categories['industries'], null, ['multiple', 'placeholder' => 'Choose your options']) !!}-->
		<select name="industry_list[]" id="industry_list" multiple>
			<option value="" disabled selected>Select industries...</option>
			@foreach($categories['industries'] as $id => $industry)
				<option value="{{ $id }}" @if($type == 'edit') {{ in_array($id, $selections['industries']) ? 'selected' : '' }}@endif>{{ $industry }}</option>
			@endforeach
		</select>
		{!! Form::label('industry_list', 'Industries*') !!}<br />
	</div>

	@for ($i = 1; $i <= count($categories['industries']); $i++)
		<div class="input-field form-indent" id="{{ 'domain_list_'.$i }}">
			{!! Form::select('domain_list[]', $categories['domains'][$i], null, ['id' => 'domain_list_sel_'.$i, 'multiple', 'placeholder' => 'Choose your options']) !!}
			{!! Form::label('domain_list_'.$i, $categories['industries'][$i].' Domains*') !!}<br />
		</div>
	@endfor
</div>

<div class="row">
	<h4 class="center">Restricted Information</h4>
	<p class="center">(only admin users will see this information)</p><br />

	<div class="input-field col s12 m6">
		{!! Form::select('partner_status', [0 => 'No Partnership',1 => 'In Development',2 => 'Active Partner',3 => 'Past Partner'], null) !!}
		{!! Form::label('partner_status', 'Partner Status*') !!}<br />
	</div>

	<div class="input-field col s12 m6">
		{!! Form::select('in_talks', [0 => 'No', 1 => 'Yes'], null) !!}
		{!! Form::label('in_talks', 'In Talks*') !!}<br />
	</div>
</div>

<div class="row center">
	<button class="btn-large waves-effect waves-light" type="submit" name="action">
	    @if($type == 'create')
	    	Add Organisation<i class="material-icons left">add</i>
	    @elseif($type == 'edit')
	    	Update Organisation<i class="material-icons left">sync</i>
	    @endif
  	</button>
</div>

<script type="text/javascript">
	$(".org-create").validate({
		rules: {
			name: "required",
			website: "required",
			short_desc: {
				required: true,
				maxlength: 160
			},
			logo: {
				required: true,
				extension: "jpg|jpeg|png|gif"
			},
			technology_list: "required",
			industry_list: "required",
			domain_list: "required",
		},
		messages: {
            logo: {
                extension: "An image is required." 
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

<script type="text/javascript">
	// edit org logo
	$("a#edit_logo").click(function(){
		document.getElementById("new_logo").style.display='block';
		document.getElementById("cur_logo").style.display='none';
	});
	
	// tag select2 settings
	$('.tag_list').select2({ 
		placeholder: 'Select all applicable, or add your own', 
		tags: true,
		tokenSeparators: [',', ';'],
		minimumInputLength: 1,
    });
 
	
    var industry = $('#industry_list');
    var industryCount = {{ count($categories['industries']) }};

	// initial update of domains    
    updateDomains();

	// update domains whenever industries are changed
    industry.change(function() {
        updateDomains();
    }); 

    function updateDomains() {
    	var selection = industry.val();

	    for(var i = 1; i <= industryCount; i++) {
	    	if(selection.indexOf(i.toString()) >= 0) {
	    		// if domain is selected
	    		document.getElementById("domain_list_"+i).style.display='block';
	    	}
	    	else {
	    		// if domain is not selected/deselected
	    		var domain = document.getElementById("domain_list_sel_"+i).options;
			    for(var j = 0; j < domain.length; j++){
			    	domain[j].selected = false;
			    }
	    		document.getElementById("domain_list_"+i).style.display='none';
	    	}
	    }
    }
</script>