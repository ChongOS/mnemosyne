var counter = 0;

var increaseCounterCurrentScore = function() {
	
	window.setInterval(function(){
		
		if (counter <= score) {
			
			$('#current-score').text('Score : ' + counter);
						
			counter++;
			
		}
		
	}, 5);
		
};

var decreaseCounterCurrentScore = function() {
	
	window.setInterval(function(){
		
		if (counter >= score) {
			
			$('#current-score').text('Score : ' + counter);
						
			counter--;
			
		}
		
	}, 5);
	
};


var init = function() {
	
	if (counter > score) {
		
		decreaseCounterCurrentScore();
		
	}
	
	else {
		
		increaseCounterCurrentScore();
		
	}
	
};

$(document).ready(init);