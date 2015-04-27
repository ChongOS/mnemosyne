var numOfCard;
var counter = 1;

var updateWindowHeight = function() {
	// 250
	$('#card-container').height($(window).height() - 300);
};

var disableInActiveCard = function() {
	
	// Disable all control access on all in active cards
	
	$('.right-card').find('*').prop('disabled', true);
	$('.middle-card').find('*').prop('disabled', false).find('.submit-button').prop('disabled', true);
	
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
	
	var isLastCard = 0;
	
	if (counter === numOfCard) {
		isLastCard = 1;
	}
	
	var textField = $(this).parent().find('input[type=text]');
		
	$.ajax({
		type: 'POST',
		url: '/mnemosyne/Decks/validateCard',
		data: {id: textField.attr('id'), value: textField.attr('data-answer'), lastCard: isLastCard}
		
	}).done(function(data){
		
		var ajaxResponse = $.parseJSON(data);
		
		if (ajaxResponse.action === 'redirect') {
			window.location.href = ajaxResponse.value;
		}
	
		if (ajaxResponse.action === 'correct') {
			$('#notification p').html('<i class="mdi-navigation-check"></i> Correct :)');
			$('#notification').addClass('correct').removeClass('wrong').fadeIn(1000).fadeOut(3000);
		}
		else {
			$('#notification p').html('<i class="mdi-navigation-close"></i> Wrong :(');
			$('#notification').addClass('wrong').removeClass('correct').fadeIn(1000).fadeOut(3000);
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
	
	$('.collection-item').draggable({revert: 'invalid', snap: '.droppable', helper: 'clone', snapMode: 'corner', snapTolerance: '22'});
	
	$('.input-field input[type=text]').droppable({accept: '.collection-item', drop: function(event, ui){
		$(this).val($(ui.draggable).text());
		$(this).attr('data-answer', $(ui.draggable).html());
		$(this).parent().siblings('.submit-button').prop('disabled', false);

	}});
				
};

$(document).ready(init);