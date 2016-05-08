<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox({
			padding: [0, 10, 0, 10],
			width: 450,
			autoSize: false,
			autoHeight: true,
			callbackOnShow:function(){
				$("#document_form > .doc_form").validate();
			}
		});
	});
</script>