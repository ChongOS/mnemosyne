<?php
/**
 * Created by PhpStorm.
 * User: chongos
 * Date: 4/20/15 AD
 * Time: 9:28 PM
 */

 
class ProfileController extends AppController {
	
	public $uses = ['Deck', 'Badge', 'UserBadge', 'User', 'FavoriteDeck'];

    public function index() {
		$user_id = $this->Auth->user('id');
        $user = $this->User->find('first', [
            'conditions' => ['User.id' => $user_id

            ],
                'recursive' => -1
            ]
        );
		
		$deck = $this->Deck->find('all');
		
		$badge_user = $this->UserBadge->find('all', [
            'conditions' => ['UserBadge.user_id' => $user_id

            ],
                'recursive' => 0
            ]
        );
		
		$this->show_created_deck();
		$this->show_favorite_deck();
		$this->set('userObj', $user);
		$this->set('deckShow', $deck);
		$this->set('uBadge', $badge_user);
    }
	
	public function show_created_deck() {
		
		$user_id = $this->Auth->user('id');
		//echo $user_id;
		
		$deck = $this->Deck->find('all', [
            'conditions' => ['Deck.user_id' => $user_id
			],
				'recursive' => -1
			]
		);
		$count_deck = count($deck);
		
		//$this->set('countDeck',$count_deck);
		$this->set('createdDeck',$deck);
		
		
	}
	
	public function show_favorite_deck() {
		
		$user_id = $this->Auth->user('id');
			
		$favDeck = $this->FavoriteDeck->find('all', [
			'conditions' => ['FavoriteDeck.user_id' => $user_id
			],
				'recursive' => 0
			]
				
		);
		
		//print_r($favDeck);

		$this->set('favoriteDeck',$favDeck);
		
	}


}
