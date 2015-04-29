<?php

class DecksController extends AppController {

    public $uses = array('Deck', 'Card', 'Score', 'User');

    public $components = array('RequestHandler');

	public function index() {
		
		// Desks info page allow the user to choose between 'Learn' or 'Review' mode
		
		$this->redirect(["controller" => "Decks", "action" => "learnMode"]);
		
	}
	
	public function reviewMode($deckID = null) {
		
		// Enter 'Reviewing' mode

        if (! is_null($deckID)) {
	        
	        // Store deckID for later usage
	        $this->Session->write('deckID', $deckID);

            if ($this->request->is('get')) {

                $deck = $this->Deck->find('first', array('conditions' => array('Deck.id' => $deckID),
                    'fields' => array('name'),
                    'recursive' => -1
                ));
                
                $cards = $this->Card->find('all', array('conditions' => array('deck_id' => $deckID),
                    'fields' => array('front', 'back'),
                    'order' => 'sort_number ASC',
                    'recusive' => -1
                ));
                
				$answer = array();
                
                foreach ($cards as $card) {
	            	array_push($answer, $card['Card']['back']);    
                }
                                
                // Store the answers for later validation
                $this->Session->write('answer', $answer);
                
                // Set the intial score to 200
				$this->Session->write('score', 0);
                
                $this->set('cards', $cards);

                $this->set('deck_name', $deck['Deck']['name']);
                				
            }

        }
        else {

            // $this->Session-setFlash();
            // $this->redirect();

        }

	}

	public function learnMode($deckID = null) {

        // Enter 'Learning mode'
        if (! is_null($deckID)) {
	        
			// Store deckID for later usage
	        $this->Session->write('deckID', $deckID);

            if ($this->request->is('get')) {

                // If deckID != null then go to the learn page

                $deck = $this->Deck->find('first', array('conditions' => array('Deck.id' => $deckID),
                    'fields' => array('name'),
                    'recursive' => -1
                ));

                $cards = $this->Card->find('all', array('conditions' => array('deck_id' => $deckID),
                    'fields' => array('front', 'back'),
                    'order' => 'sort_number ASC',
                    'recusive' => -1
                ));

                $this->set('deck_name', $deck['Deck']['name']);
                $this->set('cards', $cards);

            }

        }
        else {

            // $this->Session->setFlash();
            // $this->redirect();

        }
		
	}
	
	public function validateCard() {
		
		// For card validation
		
		function _prepareString($string) {
			$string = str_replace('{', '', $string);
			$string = str_replace('}', '', $string);
			$string = str_replace('\'', '', $string);
			$string = explode(':', $string, 2);
			$result = array('type' => $string[0], 'data' => $string[1]);
			return $result;
		}
		
		$this->autoRender = false;
		
		$this->request->allowMethod(array('ajax'));
		
		if ($this->request->is('ajax')) {
						
			$id = $this->request->data['id'];
			$answer = $this->request->data['value'];
			$currentScore = $this->Session->read('score');
			$correctAnswer = $this->Session->read('answer');
							
			if (_prepareString($correctAnswer[$id])['data'] == $answer) {
				
				// Increase the score, if user can answer the question
				
				$currentScore += 100;
				$this->Session->write('score', $currentScore);
				$return['action'] = 'correct';
				$return['score'] = $currentScore;
				
			}
				
			else {
				
				// Decrease the score, if user can't answer the question
				
				$currentScore -= 100;
				$this->Session->write('score', $currentScore);
				$return['action'] = 'wrong';
				$return['score'] = $currentScore;
				
			}
			
			$isLastCard = $this->request->data['lastCard'];
			
			if ($isLastCard == 1) {
				
				// if it's the last card, then force redirect
				
				$return['action'] = 'redirect';
				$return['value'] = Router::url(array('controller' => 'Decks', 'action' => 'result'));
			}
			
			$return['json'] = json_encode($return);
			echo json_encode($return);
			
		}
			
		die();
						
	}
	
	public function timeOut() {
		
		// Fetch the correct url, for timeout force redirection
		
		$this->autoRender = false;
		
		$this->request->allowMethod(array('ajax'));
		
		if ($this->request->is('ajax')) {
			
			$return['action'] = 'redirect';
			$return['value'] = Router::url(array('controller' => 'Decks', 'action' => 'result'));
			
			$return['json'] = json_encode($return);
			echo json_encode($return);
			
		}
		
		die();
		
	}
	
	public function result() {
		
		$score = $this->Session->read('score');
		$userID = $this->Auth->user('id');
		$deckID = $this->Session->read('deckID');
				
		// Check if the user already has the score(s)
		
		if (! $this->Score->hasAny(array('user_id' => $userID))) {
			
			// Set initial score to 1000, [BONUS] for the new comer :D
			
			$score += 1000;
			
		}
		
		// Fetch the last user's score on this deck
		
		$query = $this->Score->find('first', array('conditions' => array('deck_id' => $deckID, 'user_id' => $userID),
			'fields' => array('score'),
			'recursive' => -1));
			
		$lastScoreOnThisDeck = $query['Score']['score']; 
			
		// Update the user's score
									
		$data = array('score' => $score, 'user_id' => $userID, 'deck_id' => $deckID);
						
		if (! $this->Score->save($data)) {
				
			// If save process failed, notify a user in the result page
				
			$this->Session->setFlash('Unable to update the user\'s score');
				
		}
		
		// Show in the result page
		
		$this->set->('score', $score);
		
		$this->set->('lastScoreOnThisDeck', $lastScore);
		
	}
	
}