<!-- Comment Form Validation -->
<script type="text/javascript">

    /** Attachments Form Validation **/

    $("#document-form").validate({
        rules: {
            file: "required",
            name: "required",
            description: "required",
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

    $("#link-form").validate({
        rules: {
            url: "required",
            description: "required",
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

    /** Contributor Form Validation **/

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

    /** Comment Form Validation **/

	$("#comment-form").validate({
		rules: {
			body: "required",
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

	$("#comment-edit-form").validate({
		rules: {
			body: "required",
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

	$("#comment-reply-form").validate({
		rules: {
			body: "required",
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


    /** Fancybox js **/

    $(document).ready(function() {
        $(".fancybox").fancybox({
            padding: [0, 10, 0, 10],
            width: 450,
            autoSize: false,
            autoHeight: true,
            closeBtn: false,
            callbackOnShow:function(){
                $("#document_form > .doc_form").validate();
            }
        });
    });
</script>