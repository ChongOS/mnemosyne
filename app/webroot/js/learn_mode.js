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
	$('#counter').text('Card: ' + counter + ' of ' + numOfCard);
	
};

var nextCard = function() {
	var middleCard = $('.middle-card');
	middleCard.next().addClass('middle-card').removeClass('right-card');
	middleCard.addClass('left-card').removeClass('middle-card');
	counter++;
	updateUI();
	disableInActiveCard();
	fixZIndex();
};

var previousCard = function() {
	var middleCard = $('.middle-card');
	middleCard.prev().addClass('middle-card').removeClass('left-card');
	middleCard.addClass('right-card').removeClass('middle-card');
	counter--;
	updateUI();
	disableInActiveCard();
	fixZIndex();
};

var fixZIndex = function() {
	
	// middle-card's z-index is always 3
	
	var zIndex = 2;
	
	$('.middle-card').css('z-index', '3');
	
	$('.right-card').each(function(){
		
		$(this).css('z-index', zIndex);
		
		zIndex--;
		
	});
	
	zIndex = 2;
	
	$('.left-card').reverse().each(function(){
		
		$(this).css('z-index', zIndex);
		
		zIndex--;
		
	});
	
};

var init = function() {
	
	$(window).resize(updateWindowHeight);
	updateWindowHeight();
	
	$('.btn-flat').click(flipCard);
	
	disableInActiveCard();
	
	fixZIndex();
	
	$('#btn-next').click(nextCard);
	$('#btn-back').click(previousCard);
	
	$('.preloader-wrapper').fadeOut(1400);
	$('.top-bottom-padding-adjustment').fadeIn(2000);
	
	numOfCard = $('.card').length;
	
	$('#counter').text('Card: ' + counter + ' of ' + numOfCard);
			
};

$(document).ready(init);