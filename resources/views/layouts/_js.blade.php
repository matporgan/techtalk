<script type="text/javascript">
	$(document).ready(function(){
	    $('.button-collapse').sideNav();
	    $('select').material_select();
	    $('.collapsible').collapsible({
			accordion: false
		});
		$('.modal-trigger').leanModal();
		$('.scrollspy').scrollSpy();
		$('.tooltipped').tooltip({delay: 50});
	});
	
	function onReady(callback) {
	    var intervalID = window.setInterval(checkReady, 1000);
	    function checkReady() {
	        if (document.getElementsByTagName('body')[0] !== undefined) {
	            window.clearInterval(intervalID);
	            callback.call(this);
	        }
	    }
	}
	
	onReady(function () {
	    $('#loading').fadeToggle();
	    grid.masonry('layout'); // reload masonry if present

		// typed.js logo
	    $("#typed").typed({
			strings: ["tech ^300 talk"],
			startDelay: 500,
			typeSpeed: 150
		});
	});
</script>