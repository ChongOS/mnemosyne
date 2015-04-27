<?php

class DecksController extends AppController {

    public $uses = array('Deck', 'Card');

    public $components = array('RequestHandler');

	public function index() {
		
		// Desks info page allow the user to choose between 'Learn' or 'Review' mode
		
		$this->redirect(["controller" => "Decks", "action" => "learnMode"]);
		
	}
	
	public function reviewMode($deckID = null) {
		
		// Enter 'Reviewing' mode

        if (! is_null($deckID)) {

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

                function _prepareString($string) {
                    $string = str_replace('{', '', $string);
                    $string = str_replace('}', '', $string);
                    $string = str_replace('\'', '', $string);
                    $string = explode(':', $string, 2);
                    $result = array('type' => $string[0], 'data' => $string[1]);
                    return $result;
                }


                // Mapping
                for ($i=0; $i<sizeof($cards)-1; $i++) {
                    $indexAnswerMap[$i] = _prepareString($cards[$i]['Card']['back'])['data'];
                }

                // Store the correct answer for later validation
                $this->Session->write('correct_answer', $indexAnswerMap);

                pr($indexAnswerMap);

                $this->set('deck_name', $deck['Deck']['name']);
            }

            else if ($this->request->is('post')) {

                // Validate the answer

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
}