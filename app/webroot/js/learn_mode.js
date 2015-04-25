var updateWindowHeight = function() {
	$('#card-container').height($(window).height() - 250);
};

var disableInActiveCard = function() {
	$('.left-card > *').prop('disabled', true);
	$('.right-card > *').prop('disabled', true);
}

var init = function init() {
	
	$(window).resize(updateWindowHeight());
	updateWindowHeight();
	
	
};

$(document).ready(init);