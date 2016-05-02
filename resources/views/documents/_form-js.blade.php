<script type="text/javascript">
	// Auto-populates the document name field
	$('#upload').change(function() {
	    var filename = $(this).val();
	    var lastIndex = filename.lastIndexOf("\\");
	    if (lastIndex >= 0) {
	        filename = filename.substring(lastIndex + 1);
	    }
	    $('#filename').val(filename.replace(/\.[^/.]+$/, ""));
	});

	// lightbox js
	$(document).ready(function() {
		$(".fancybox").fancybox({
			padding: 0
		});
	});
</script>