/**
 * Toggles block/none display property for an element.
 * 
 * @param  string id
 * @param  boolean value
 */
function show(id, value) {
    document.getElementById(id).style.display = value ? 'block' : 'none';
} 

/**
 * Toggles show/hide for an element by id.
 * 
 * @param  string id
 */
function showhide(id) {
	var display = $(id).css('display');
	$(id).css('display') == 'none' ? 'block' : 'none';
}

function onReady(callback) {
    var intervalID = window.setInterval(checkReady, 1000);
    function checkReady() {
        if (document.getElementsByTagName('body')[0] !== undefined) {
            window.clearInterval(intervalID);
            callback.call(this);
        }
    }
}