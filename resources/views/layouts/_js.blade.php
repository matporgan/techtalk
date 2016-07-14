<script type="text/javascript">
	$(document).ready(function(){
	    $('.button-collapse').sideNav();
	    $('select').material_select();
	    $('.collapsible').collapsible({
			accordion: false
		});
		$('.modal-trigger').leanModal();
		//$('.scrollspy').scrollSpy();
		//$('.tooltipped').tooltip({delay: 50});
		$('.parallax').parallax();
		$('.linkify').linkify();
	});

	onReady(function () {
	    $('#loading').fadeToggle();
	});
</script>
