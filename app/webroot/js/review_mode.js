var numOfCard;
var counter = 1;
var circle;

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
						
			$('#notification p:first').html('<i class="mdi-navigation-check"></i> Correct :)').addClass('correct').removeClass('wrong').fadeIn().addClass('show').fadeOut(3000, function() { $(this).removeClass('show'); });
			
			$('#score').text('Current score : ' + ajaxResponse.score);
			
		}
		else {
			
			$('#notification p:first').html('<i class="mdi-navigation-close"></i> Wrong :(').addClass('wrong').removeClass('correct').fadeIn().addClass('show').fadeOut(3000, function() { $(this).removeClass('show'); });
			
			$('#score').text('Current score : ' + ajaxResponse.score);
			
		}
		
	}).fail(function(){
		
		$('#notification p:first').html('<i class="mdi-navigation-close"></i> Connection failed').addClass('wrong').removeClass('correct').fadeIn().addClass('show').fadeOut(3000, function() { $(this).removeClass('show'); });
		
	});
	
	var card = $(this).parents('.card');
	card.next().addClass('middle-card').removeClass('right-card');
	card.addClass('move-off').fadeOut(500);
	disableInActiveCard();
	
	counter++;
	$('#counter').text('Card: ' + counter + ' of ' + numOfCard);
	
	// Reset a timer
	circle.set(0);
	circle.animate(1, timeOut);
	
	
};

var timeOut = function() {
	
	$('#notification p:first').html('<i class="mdi-navigation-close"></i> Time is up !').addClass('wrong').removeClass('correct').fadeIn().addClass('show').fadeOut(3000, function() { $(this).removeClass('show'); });
	
	// Prevent user intervention if the network is slow
	$('.middle-card').find('*').prop('disabled', true);
	
	$.ajax({
		type: 'POST',
		url: '/mnemosyne/Decks/timeOut'
				
	}).done(function(data){
		
		var ajaxResponse = $.parseJSON(data);
		
		if (ajaxResponse.action === 'redirect') {
			window.location.href = ajaxResponse.value;
		}
		
	}).fail(function(){
		
		$('#notification p:first').html('<i class="mdi-navigation-close"></i> Connection failed').addClass('wrong').removeClass('correct').fadeIn().addClass('show').fadeOut(3000, function() { $(this).removeClass('show'); });
		
	});
	
};

var init = function() {
	
	// Set and update the fixed absolute window size
	$(window).resize(updateWindowHeight);
	updateWindowHeight();
	
	// flip the card if answer button was clicked
	$('.answer-button').click(flipCard);
	
	// right-card must be disabled at inititial
	disableInActiveCard();
			
	// remove the preloader, then show the cards
	$('.preloader-wrapper').fadeOut(1400);
	$('.top-bottom-padding-adjustment').fadeIn(2000);
	
	// number of card = length of card's jQuery object
	numOfCard = $('.card').length;
	
	// initial the card's counter
	$('#counter').text('Card: ' + counter + ' of ' + numOfCard);
	
	// call the ajax for checking the answer, then move to the next card
	$('.submit-button').click(checkAnswer);
	
	// Set the 'collection' class as draggable
	$('.collection-item').draggable({revert: 'invalid', snap: '.droppable', helper: 'clone', snapMode: 'corner', snapTolerance: '22'});
	
	// Set the 'input-field' class as droppable
	$('.input-field input[type=text]').droppable({accept: '.collection-item', drop: function(event, ui){
		$(this).val($(ui.draggable).text());
		$(this).attr('data-answer', $(ui.draggable).html());
		$(this).parent().siblings('.submit-button').prop('disabled', false);

	}});
	
	
	// Instantiate a new Circle timer
	circle = new ProgressBar.Circle('#timer-container', {
		color: '#EC6F75',
		strokeWidth: 8,
		trailWidth: 4,
		duration: 10000,
		text: {
        	value: '0'
    	},
		step: function(state, bar) {
        	bar.setText((bar.value() * 10).toFixed(0));
    	}
	});		
		
	
	// Start a begin timer
	circle.animate(1, timeOut);
	
};

$(document).ready(init);