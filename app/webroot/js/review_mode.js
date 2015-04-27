var numOfCard;
var counter = 1;

var updateWindowHeight = function() {
	// 250
	$('#card-container').height($(window).height() - 300);
};

var disableInActiveCard = function() {
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

var checkAnswer = function() {
	
	var textField = $(this).parent().find('input[type=text]');
		
	$.ajax({
		type: 'POST',
		url: '/mnemosyne/Decks/validateCard',
		data: {id: textField.attr('id'), value: textField.val()}
		
	}).done(function(data){
		
		if (data === 'correct') {
			$('#notification h5').text('Correct :)');
			$('#notification').addClass('success').removeClass('wrong').fadeIn(500).fadeOut(1600);
		}
		else {
			$('#notification h5').text('Wrong :(');
			$('#notification').addClass('wrong').removeClass('correct').fadeIn(500).fadeOut(1600);
		}
		
	});
	
	var card = $(this).parents('.card');
	card.next().addClass('middle-card').removeClass('right-card');
	card.addClass('move-off').fadeOut(500);
	disableInActiveCard();
	
	counter++;
	$('#counter').text(counter + ' of ' + numOfCard);
	
	
};

var init = function() {
	
	$(window).resize(updateWindowHeight);
	updateWindowHeight();
	
	$('.answer-button').click(flipCard);
	
	disableInActiveCard();
			
	$('.preloader-wrapper').fadeOut(1400);
	$('.top-bottom-padding-adjustment').fadeIn(2000);
	
	numOfCard = $('.card').length;
	
	$('#counter').text(counter + ' of ' + numOfCard);
	
	$('.submit-button').click(checkAnswer);
		
};

$(document).ready(init);