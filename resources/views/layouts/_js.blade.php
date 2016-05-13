<script type="text/javascript">
	$(document).ready(function(){
	    $('.button-collapse').sideNav();
	    $('select').material_select();
	    $('.collapsible').collapsible({
			accordion: false
		});
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
	    // reload masonry if present
	    grid.masonry('layout');
	});
</script>