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

                // Use a string matching as an validation approach

                foreach ($cards as $card) {
                    $questionAnswerMap[_prepareString($card['Card']['front'])['data']] = _prepareString($card['Card']['back'])['data'];
                }

                // Store the correct answer for later validation

                $this->Session->write('correct_answer', $questionAnswerMap);

                // Generating the set of answers for multi-choices

                foreach ($questionAnswerMap as $key => $value) {

                    $toSelectArray = $questionAnswerMap;

                    // Exclude it's own answer from being selected, which can lead to duplicate options
                    unset($toSelectArray[$key]);

                    if (sizeof($questionAnswerMap) >= 5) {

                        $randomSelection = array_rand($toSelectArray, 4);

                    }
                    else {

                        $randomSelection = array_rand($toSelectArray, sizeof($questionAnswerMap) - 1);

                    }

                    // Map the values back to the key
                    $randomized = array();
                    foreach ($randomSelection as $key) {
                        array_push($randomized, $questionAnswerMap[$key]);
                    }

                    // Add its answer back, then shuffle the options
                    array_push($randomized, $value);
                    shuffle($randomized);

                    pr($randomized);

                }

                /*
                $this->set('cards', $cards);

                $this->set('choices', $randomized);

                $this->set('deck_name', $deck['Deck']['name']);
                */
            }

            else if ($this->request->is('post')) {

                // Validate the answer

                // $this->set('', '');

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