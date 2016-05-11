<div class="row">
	<h4 class="center">General Information</h4><br />

	<div class="input-field">
		{!! Form::text('name', null) !!}
		{!! Form::label('name', 'Name*', ['id' => 'name', 'class' => 'active']) !!}
	</div>

	<div class="input-field">
		{!! Form::text('website', null) !!}
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

	<div class="input-field">
		<input name="tag_list" id="tag_list" class="typeahead" type="text" value="@if($type == 'edit') {{ $selections['tags'] }} @endif" data-role="materialtags"/>
		{!! Form::label('tag_list', 'Tags') !!}
		<span class="subtitle">(seperate with tab)</span>
		<br /><br />
	</div>

	@if($type == 'create')
		<div class="file-field input-field">
			<div class="btn">
				<i class="material-icons left">attach_file</i>
				<span>Logo*</span>
				<input type="file" name="logo">
			</div>
			<div class="file-path-wrapper">
				<input class="file-path" type="text">
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
				<input class="file-path" type="text">
			</div>
		</div><br />
	@endif
</div>

<div class="row">
	<h4 class="center">Categorization</h4><br />

	<div class="input-field">
		<select name="technology_list[]" id="technology_list" multiple>
			<option value="" disabled selected>Select technologies...</option>
			@foreach($categories['technologies'] as $id => $technology)
				<option value="{{ $id }}" @if($type == 'edit') {{ in_array($id, $selections['technologies']) ? 'selected' : '' }} @endif>{{ $technology }}</option>
			@endforeach
		</select>
		{!! Form::label('technology_list', 'Technologies*') !!}
		<div id="technology-error" class="custom-error" style="display:none;">This field is required.</div><br />
	</div>
	
	<div class="input-field">
		<select name="industry_list[]" id="industry_list" multiple>
			<option value="" disabled selected>Select industries...</option>
			@foreach($categories['industries'] as $id => $industry)
				<option value="{{ $id }}" @if($type == 'edit') {{ in_array($id, $selections['industries']) ? 'selected' : '' }}@endif>{{ $industry }}</option>
			@endforeach
		</select>
		{!! Form::label('industry_list', 'Industries*') !!}
		<div id="industry-error" class="custom-error" style="display:none;">This field is required.</div><br />
	</div>

	@for ($i = 1; $i <= count($categories['industries']); $i++)
		<div class="input-field" id="domain-{{ $i }}">
			<select name="domain_list[]" id="domain_list_{{ $i }}" multiple>
				<option value="" disabled selected>Select domains...</option>
				@foreach($categories['domains'][$i] as $id => $domain)
					<option value="{{ $id }}" @if($type == 'edit') {{ in_array($id, $selections['domains']) ? 'selected' : '' }}@endif>{{ $domain }}</option>
				@endforeach
			</select>
			{!! Form::label('domain_list_'.$i, $categories['industries'][$i].' Domains*') !!}
			<div id="domain-error-{{ $i }}" class="custom-error" style="display:none;">This field is required.</div><br />
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
// materialize-tags script

var substringMatcher = function(strs) {
	return function findMatches(q, cb) {
	var matches, substringRegex;

	// an array that will be populated with substring matches
	matches = [];

	// regex used to determine if a string contains the substring `q`
	substrRegex = new RegExp(q, 'i');

	// iterate through the pool of strings and for any string that
	// contains the substring `q`, add it to the `matches` array
	$.each(strs, function(i, str) {
		if (substrRegex.test(str)) {
			matches.push(str);
		}
	});
	cb(matches);
  };
};

var tags = {!! json_encode($categories['tags']) !!};

$('#tag_list').materialtags({
	typeaheadjs: {
		name: 'tags',
  		source: substringMatcher(tags)
  	}
});

</script>

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
			test: "required",
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


	function validateForm() {
		var result = true;
	    if ($('#technology_list').val() == "") {
	        document.getElementById("technology-error").style.display='block';
	        result = false;
	    }
	    if ($('#industry_list').val() == "") {
	        document.getElementById("industry-error").style.display='block';
	        result = false;
	    }
		for(var i = 1; i <= industryCount; i++) {
			if($('#industry_list').val().indexOf(i.toString()) >= 0) {
				if ($('#domain_list_'+i).val() == null) {
					document.getElementById("domain-error-"+i).style.display='block';
			        result = false;
			    }
			}
		}
	    return result;
	}

	function updateValidation() {
		if ($('#technology_list').val() != "") {
			alert('tech-hide');
			document.getElementById("technology-error").style.display='none';
		}
		if ($('#industry_list').val() != "") {
			alert('ind-hide');
			document.getElementById("industry-error").style.display='none';
		}
	    @for($i = 1; $i <= count($categories['industries']); $i++)
		    if ($('#domain_list_{{ $i }}').val() != "") {
		    	alert('dom{{ $i }}-hide');
		        document.getElementById("domain-error-{{ $i }}").style.display='none';
		    } 
		@endfor
	}



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
		if ($('#industry_list').val() != "") {
			document.getElementById("industry-error").style.display='none';
		}
        updateDomains();
    }); 
    $('#technology_list').change(function() {
		if ($('#technology_list').val() != "") {
			document.getElementById("technology-error").style.display='none';
		}
    });
    @for($i = 1; $i <= count($categories['industries']); $i++)
	    $('#domain_list_{{ $i }}').change(function() {
		    if ($('#domain_list_{{ $i }}').val() != "") {
		        document.getElementById("domain-error-{{ $i }}").style.display='none';
		    } 
	    }); 
	@endfor

    function updateDomains() {
    	var selection = industry.val();

	    for(var i = 1; i <= industryCount; i++) {
	    	if(selection.indexOf(i.toString()) >= 0) {
	    		// if domain is selected
	    		document.getElementById("domain-"+i).style.display='block';
	    	}
	    	else {
	    		// if domain is not selected/deselected
	    		var domain = document.getElementById("domain_list_"+i).options;
			    for(var j = 0; j < domain.length; j++){
			    	domain[j].selected = false;
			    }
	    		document.getElementById("domain-"+i).style.display='none';
	    	}
	    }
    }
</script>