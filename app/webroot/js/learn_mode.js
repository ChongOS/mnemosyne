var numOfCard;
var counter = 1;

var updateWindowHeight = function() {
	// 250
	$('#card-container').height($(window).height() - 300);
};

var disableInActiveCard = function() {
	$('.left-card').find('*').prop('disabled', true);
	$('.right-card').find('*').prop('disabled', true);
	$('.middle-card').find('*').prop('disabled', false);
	
};

var flipCard = function() {
	var cardWrapper = $(this).parents('.card-wrapper');
	if (cardWrapper.hasClass('flipped')) {
		cardWrapper.removeClass('flipped');
	}
	else {
		cardWrapper.addClass('flipped');
	}
	
};

var updateUI = function() {
	var middleCard = $('.middle-card');
	if (middleCard.next().length === 0) {
		$('#btn-next').addClass('disabled').prop('disabled', true);
	}
	else {
		$('#btn-next').removeClass('disabled').prop('disabled', false);
	}
	if (middleCard.prev().length === 0) {
		$('#btn-back').addClass('disabled').prop('disabled', true);
	}
	else {
		$('#btn-back').removeClass('disabled').prop('disabled', false);
	}
	$('#counter').text(counter + ' of ' + numOfCard);
	
};

var nextCard = function() {
	var middleCard = $('.middle-card');
	middleCard.next().addClass('middle-card').removeClass('right-card');
	middleCard.addClass('left-card').removeClass('middle-card');
	counter++;
	updateUI();
	disableInActiveCard();
};

var previousCard = function() {
	var middleCard = $('.middle-card');
	middleCard.prev().addClass('middle-card').removeClass('left-card');
	middleCard.addClass('right-card').removeClass('middle-card');
	counter--;
	updateUI();
	disableInActiveCard();
};

var init = function() {
	
	$(window).resize(updateWindowHeight);
	updateWindowHeight();
	
	$('.btn-flat').click(flipCard);
	
	disableInActiveCard();
	
	$('#btn-next').click(nextCard);
	$('#btn-back').click(previousCard);
	
	$('.preloader-wrapper').fadeOut(1400);
	$('.top-bottom-padding-adjustment').fadeIn(2000);
	
	numOfCard = $('.card').length;
	
	$('#counter').text(counter + ' of ' + numOfCard);
			
};

$(document).ready(init);