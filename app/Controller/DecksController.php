<?php

class DecksController extends AppController {
	
	public function index() {
		
		// Desks info page allow the user to choose between 'Learn' or 'Review' mode
		
		$this->redirect(["controller" => "Decks", "action" => "learnMode"]);
		
	}
	
	public function reviewMode() {
		
		// Enter 'Review' mode
		
		
		
	}
	
	public function learnMode() {
		
		// Enter 'Learn' mode
		
	}
	
}