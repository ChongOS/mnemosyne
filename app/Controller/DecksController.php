<?php
/**
 * Created by PhpStorm.
 * User: chongos
 * Date: 4/23/15 AD
 * Time: 12:23 PM
 */

class DecksController extends AppController {

    public $uses = ['Deck', 'Category', 'Card', 'Tag', 'User', 'DeckTag', 'FavoriteDeck', 'Score', 'Badge', 'UserBadge'];

    public function index() {
        $this->__getCategories();
    }
    
    public function category($category_id = null) {
        $this->__getCategories();
        $this->set('category_id', $category_id);
        $decks = $this->Deck->find('all', [
            'conditions' => ['Deck.status' => 1,'Category.id' => $category_id],
            'recursive'=> 1
        ]);
        
        $favoriteDeck = $this->FavoriteDeck->find('list', [
            'conditions' => ['FavoriteDeck.user_id' => $this->Auth->User('id')],
            'fields' => ['FavoriteDeck.deck_id'],
            'recursive'=> -1
        ]);
        $favorites = [];
        foreach($favoriteDeck as $key => $value) {
            $favorites[] = $value;
        }
        $this->set('favorite', $favorites);
        
        $tags = $this->Tag->find('list', [
            'recursive'=> -1,
            'fields' => ['Tag.id','Tag.name']
        ]);
        
        $data = [];
        foreach($decks as $deck) {
            $deckTag = [];
            foreach($deck['DeckTag'] as $tag) {
                $id = $tag['tag_id'];
                $deckTag[] = [
                    'id' => $id, 
                    'name' => $tags[$id]  
                ];
            }
            $data[] = [
                        'Deck' => $deck['Deck'],
                        'Card' => count($deck['Card']),
                        'User' => [
                            'id' => $deck['User']['id'],
                            'username' => $deck['User']['username']
                            ],
                        'Category' => $deck['Category'],
                        'Tag' => $deckTag
                      ];   
        }
        $this->set('data', $data);
    }
    
    public function add() {
        $this->__getCategories();
        $this->__getAllTags();
        
        if ($this->request->is('post')) { 
            $tags = [];
            if(!empty($this->request->data['Deck']['tags'])) {
                foreach($this->request->data['Deck']['tag'] as $tag)
                    $tags[] = ['tag_id' => $tag];
            }

            $data = [
                'Category' => ['id' => $this->request->data['Deck']['category_id']],
                'Deck' => [
                    [
                        'name' => $this->request->data['Deck']['name'],
                        'description' => $this->request->data['Deck']['description'],
                        'user_id' => $this->Auth->user('id'),
                        'Card' => json_decode($this->request->data['Deck']['cards'], true),
                        'DeckTag' => $tags
                    ]
                ]
            ];

            if($this->Category->saveAssociated($data, array('deep' => true))) {
                $this->Session->setFlash("Success");
                $this->redirect(['action' => 'edit', $this->Deck->getLastInsertId()]);
            } else {
                $this->Session->setFlash("Error");
            }

        }
    }
    
    public function edit($deck_id = null) {
        $deck = $this->Deck->find('first', [
            'conditions' => ['Deck.id' => $deck_id],
            'recursive'=> -1
        ]);
    
        if($deck['Deck']['status'] || $deck['Deck']['user_id'] != $this->Auth->User('id'))
            $this->redirect(['action' => 'stat', $deck_id]);
        
        $cards = $this->Card->find('all', [
            'conditions' => ['Card.deck_id' => $deck_id],
            'order' => ['Card.sort_number'],
            'fields' => ['Card.id', 'Card.front', 'Card.back', 'Card.sort_number']
        ]);
        
        // set deck data
        $this->set('deck', $deck);
        // set cards data
        $this->set('cards', json_encode($cards));
        // set all categories
        $this->__getCategories();
        // set all tags
        $this->__getAllTags();
        // set selected tag
        $this->__getSelectedTags($deck_id);
        
        if ($this->request->is('post')) {
            if($this->DeckTag->deleteAll(['DeckTag.deck_id' => $deck_id])) {
                
                $tags = [];
                if(!empty($this->request->data['Deck']['tag_id'])) {
                    foreach($this->request->data['Deck']['tag_id'] as $tag)
                        $tags[] = ['tag_id' => $tag];
                }
//                print_r($tags);

                $data = [
                    'Category' => ['id' => $this->request->data['Deck']['category_id']],
                    'Deck' => [
                        [  
                            'id' => $deck_id,
                            'name' => $this->request->data['Deck']['name'],
                            'description' => $this->request->data['Deck']['description'],
                            'status' => $this->request->data['Deck']['status'],
                            'Card' => json_decode($this->request->data['Deck']['cards'], true),
                            'DeckTag' => $tags
                        ]
                    ]
                ];

                if($this->Category->saveAssociated($data, array('deep' => true))) {
                    $delCard = json_decode($this->request->data['Deck']['cardDelete'], true);
                    if(!empty($delCard)) {
                        if($this->Card->deleteAll($delCard)) {
                            $this->Session->setFlash("Success");
                            $this->redirect(['action' => 'edit', $deck_id]);
                        } else {
                            $this->Session->setFlash("Error");
                            return;
                        }
                    }
                    $this->Session->setFlash("Success");
                    $this->redirect(['action' => 'edit', $deck_id]);
                } else {
                    $this->Session->setFlash("Error");
                }
            } else {
                $this->Session->setFlash("Error");
            }
        }
    }
    
    public function stat($deck_id=null) {
        $favoriteDeck = $this->FavoriteDeck->find('all', [
            'conditions' => ['deck_id' => $deck_id],
            'recursive' => 0,
            'fields' => [
                'User.id', 'User.username'
            ]
        ]);
        $this->set('favoriteDeck',$favoriteDeck);
        
        $deck = $this->Deck->find('first', [
            'conditions' => ['id' => $deck_id],
            'recursive' => -1,
            'fields' => [
                'Deck.name', 'Deck.description'
            ]
        ]);
        $this->set('deck', $deck);
        
        $scores = $this->Score->find('all', [
            'conditions' => ['deck_id' => $deck_id],
            'recursive' => 0,
            'fields' => [
                'Score.score', 'Score.modified', 'User.id', 'User.username'
            ]
        ]);
        $this->set('scores', $scores);
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
		
		function __prepareString($string) {
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
							
			if (__prepareString($correctAnswer[$id])['data'] == $answer) {
				
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
				$return['value'] = 'http://mnemosyne-flashcard.azurewebsites.net/decks/result';
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
			$return['value'] = 'http://mnemosyne-flashcard.azurewebsites.net/decks/result';
			
			$return['json'] = json_encode($return);
			echo json_encode($return);
			
		}
		
		die();
		
	}
	
	public function result($scoreID = null) {
		
		if (is_null($scoreID)) {
		
			$score = $this->Session->read('score');
			$userID = $this->Auth->user('id');
			$deckID = $this->Session->read('deckID');
				
			// Check if the user already has the score(s)
		
			if (! $this->Score->hasAny(array('user_id' => $userID))) {
			
				// Set initial score to 200, [BONUS] for the new comer :D
			
				$score += 200;
			
			}
			
			
			// Assign the badge(s), then store it to the db
			
			$badgesArray = array();
			
			// Check if user played for the first time
			
			if ($this->Score->hasAny(array('user_id' => $userID))) {
				
			
				// User played this deck up to 10 times
			
				$playedCount = $this->Score->find('count', array('conditions' => array('user_id' => $userID, 'deck_id' => $deckID), 'recursive' => -1));
			
				if ($playedCount == 10) {
					
					$longLastingBadge = $this->Badge->find('first', array('conditions' => array('name' => 'long lasting'), 'fields' => array('id', 'name', 'thumbnail', 'detail'), 'recursive' => -1));
				
					array_push($badgesArray, $longLastingBadge);
					
					if (! $this->UserBadge->hasAny(array('user_id' => $userID, 'badge_id' => $longLastingBadge['Badge']['id']))) {
					
						$data = array('user_id' => $userID, 'badge_id' => $longLastingBadge['Badge']['id']);
					
						$this->UserBadge->save($data);
						
					}
				
				}
			
				// User gains the maximum score compared to the others user on the same deck
			
				$maxScore = $this->Score->find('all', array('conditions' => array('deck_id' => $deckID),
				'fields' => array('MAX(score)'),
				'recursive' => -1));
							
				if ($score >= $maxScore[0][0]['MAX(score)']) {
					
					$maxScoreBadge = $this->Badge->find('first', array('conditions' => array('name' => 'maximum'), 'fields' => array('id', 'name', 'thumbnail', 'detail'), 'recursive' => -1));
				
					array_push($badgesArray, $maxScoreBadge);
					
					if (! $this->UserBadge->hasAny(array('user_id' => $userID, 'badge_id' => $maxScoreBadge['Badge']['id']))) {
					
						$data = array('user_id' => $userID, 'badge_id' => $maxScoreBadge['Badge']['id']);
					
						$this->UserBadge->save($data);
						
					}
				
				}
				
			}
			
			else {
				
				$newComerBadge = $this->Badge->find('first', array('conditions' => array('name' => 'new comer'), 'fields' => array('id', 'name', 'thumbnail', 'detail'), 'recursive' => -1));
				
				array_push($badgesArray, $newComerBadge);
				
				$data = array('user_id' => $userID, 'badge_id' => $newComerBadge['Badge']['id']);
					
				$this->UserBadge->save($data);
				
			}
			
			
			
			
		
			// Fetch the user's score on this deck
		
			$scoreOnThisDeck = $this->Score->find('all', array('conditions' => array('deck_id' => $deckID, 'user_id' => $userID),
				'fields' => array('score', 'created'),
				'recursive' => -1,
				'order' => 'created DESC'));
			
			// Fetch the name of the current deck
		
			$deckName = $this->Deck->find('first', array('conditions' => array('id' => $deckID), 'fields' => array('name'), 'recursive' => -1));
			
			// Update the user's score
									
			$data = array('score' => $score, 'user_id' => $userID, 'deck_id' => $deckID);
						
			if (! $this->Score->save($data)) {
				
				// If save process failed, notify a user in the result page
				
				$this->Session->setFlash('Unable to update the user\'s score');
				
			}
		
			// Show in the result page
		
			$this->set('score', $score);
		
			$this->set('scoreOnThisDeck', $scoreOnThisDeck);
		
			$this->set('deckName', $deckName['Deck']['name']);
				
			$this->set('shareURL', 'http://mnemosyne-flashcard.azurewebsites.net/decks/result/' . $this->Score->getInsertID());
					
			// This will only be set, if the user has a new badge(s) available
		
			$this->set('badgesGranted', $badgesArray);
			
		}
		
		else {
			
			$query = $this->Score->find('first', array('conditions' => array('id' => $scoreID),
			'fields' => array('score', 'user_id', 'deck_id'),
			'recursive' => -1));
			
			$score = $query['Score']['score'];
			// Fetch the user's score on this deck
		
			$scoreOnThisDeck = $this->Score->find('all', array('conditions' => array('deck_id' => $query['Score']['deck_id'], 'user_id' => $query['Score']['user_id']),
				'fields' => array('score', 'created'),
				'recursive' => -1,
				'order' => 'created DESC'));
				
			// Fetch the name of the current deck
		
			$deckName = $this->Deck->find('first', array('conditions' => array('id' => $query['Score']['deck_id']), 'fields' => array('name'), 'recursive' => -1));
			
			// Empty set of badge(s)
			$badgesArray = array();
			
						
			// Show in the result page
		
			$this->set('score', $score);
		
			$this->set('scoreOnThisDeck', $scoreOnThisDeck);
		
			$this->set('deckName', $deckName['Deck']['name']);
			
			$this->set('shareURL', 'http://mnemosyne-flashcard.azurewebsites.net/decks/result/' . $scoreID);
			
			$this->set('badgesGranted', $badgesArray);
			
		}
		
	}
    
    function __getSelectedTags($deck_id) {
        $tags = $this->DeckTag->find('all', [
            'conditions' => ['DeckTag.deck_id' => $deck_id],
            'fields' => ['Tag.id']
        ]);
        $tagID = [];
        foreach($tags as $tag) {
            $tagID[] = $tag['Tag']['id'];
        }
        $this->set('selectedTag', $tagID);
    }
    
    function __getAllTags() {
        $list = $this->Tag->find('list', [
            'recursive'=> -1,
            'order' => [
                'Tag.name' => 'ASC'
            ],
            'fields' => [
                'Tag.id', 'Tag.name'
            ]
        ]);
        $this->set('tags', $list);
    }

    function __getCategories() {
        $list = $this->Category->find('list', [
            'recursive'=> -1,
            'order' => [
                'Category.name' => 'ASC'
            ],
            'fields' => [
                'Category.id','Category.name'
            ]
        ]);
        $this->set('categories', $list);
    }
  
}
