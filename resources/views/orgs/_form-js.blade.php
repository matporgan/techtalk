<script type="text/javascript">
	// create select2 boxes
	$('.technology_list').select2({ placeholder: 'Select all applicable' });
	$('.industry_list').select2({ placeholder: 'Select all applicable' });
	$('.domain_list').select2({ placeholder: 'Select all applicable' });
	$('.tag_list').select2({ 
		placeholder: 'Select all applicable, or add your own', 
		tags: true,
		tokenSeparators: [',', ';'],
		minimumInputLength: 1,
    });

    var industry = $('.industry_list');
    var industryCount = {{ count($categories['industries']) }};
    var industry_selections;

    hideAllDomains();

	industry.on("select2:select", function (e) { 
		var selection = e.params["data"].id;
		showDomain(selection);
	});

	industry.on("select2:unselect", function (e) { 
		var unselection = e.params["data"].id;
		hideDomain(unselection);
	});

    function hideAllDomains() {
	    for(var i = 1; i <= industryCount; i++) {
	    	document.getElementById("domain_list_"+i).style.display='none';
	    }

	    // show previously selected domains - for editing a org
	    var selected = industry.val();
	    if(selected != null) {
	    	for(var i = 0; i < selected.length; i++) {
				document.getElementById("domain_list_"+selected[i]).style.display='block';
			}
	    }
    }

    function hideDomain(id) {
    	document.getElementById("domain_list_"+id).style.display='none';
    	$("#domain_list_sel_"+id).select2('val', null);
    }

    function showDomain(id) {
		document.getElementById("domain_list_"+id).style.display='block';
    }
</script>