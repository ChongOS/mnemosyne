var updateWindowHeight = function() {
	$('#card-container').height($(window).height() - 250);
};

var disableInActiveCard = function() {
	$('.left-card > *').prop('disabled', true);
	$('.right-card > *').prop('disabled', true);
};

var flipCard = function() {
	var cardWrapper = $(this).parents('.card-wrapper');
	if (cardWrapper.css('transform') === 'matrix3d(-1, 0, 0, 0, 0, 1, 0, 0, 0, 0, -1, 0, 0, 0, 0, 1)') {
		cardWrapper.css('transform', 'rotateY(0deg)');
	}
	else {
		cardWrapper.css('transform', 'rotateY(180deg)');
	}
};

var init = function init() {
	
	$(window).resize(updateWindowHeight);
	updateWindowHeight();
	
	$('.btn-flat').click(flipCard);
	
};

$(document).ready(init);