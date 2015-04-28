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
				
			// initial the score, set to 1000
			
			if (! $this->Session->check('score')) {
				$this->Session->write('score', 1000);
			}
						
			$id = $this->request->data['id'];
			$answer = $this->request->data['value'];
			$currentScore = $this->Session->read('score');
			$correctAnswer = $this->Session->read('answer');
							
			if (_prepareString($correctAnswer[$id])['data'] == $answer) {
				
				// Increase the score, if user can answer the question
				
				$this->Session->write('score', $currentScore + 100);
				$return['action'] = 'correct';
				
			}
				
			else {
				
				// Decrease the score, if user can't answer the question
				
				$this->Session->write('score', $currentScore - 100);
				$return['action'] = 'wrong';
				
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
		
		// Save latest user'sscore
		/*
		$data = array(
			'User' => array('id' => $userID),
			'Score' => array(
				'score' => $score,
 				//'user_id' => ,
				'deck_id' => $deckID
			)
		);
		
		$this->User->saveAssociated($data);
		*/
		
		
		// Get the latest 10 results
		
		$deck = $this->Deck->find('first', array('conditions' => array('Deck.id' => $deckID),
                    'fields' => array('name'),
                    'recursive' => 1
                ));
                
        $this->set('user_name', $this->Auth->user('username'));
                
        $this->set('total_score', sizeof($deck['Card']));
        		                
        $this->set('deck_name', $deck['Deck']['name']);
		
		$this->set('score', $score);
		
	}
	
}