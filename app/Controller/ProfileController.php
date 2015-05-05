<?php
/**
 * Created by PhpStorm.
 * User: chongos
 * Date: 4/20/15 AD
 * Time: 9:28 PM
 */

 
class ProfileController extends AppController {
	
	public $uses = ['Deck', 'Badge', 'UserBadge', 'User', 'FavoriteDeck', 'Card'];

    public function index() {
		$user_id = $this->Auth->user('id');
        $user = $this->User->find('first', [
            'conditions' => ['User.id' => $user_id

            ],
                'recursive' => -1
            ]
        );
		
		$deck = $this->Deck->find('all', [
			'recursive' => 0,
			'order' => array('Deck.modified'=>'DESC')
			]
		);
		
		$badge_user = $this->UserBadge->find('all', [
            'conditions' => ['UserBadge.user_id' => $user_id

            ],
                'recursive' => 0
            ]
        );
		
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
			
		$favoriteDeck = $this->FavoriteDeck->find('list', [
            'conditions' => ['FavoriteDeck.user_id' => $this->Auth->User('id')],
            'fields' => ['FavoriteDeck.deck_id'],
            'recursive'=> -1
        ]);
//        $favorites = [];
        $deck = [];
        foreach($favoriteDeck as $key => $value) {
//            $favorites[] = $value;
            
            $deck[] = $this->Deck->find('first', [
                'conditions' => ['Deck.id' => $value],
				'recursive' => 0
			]
            
		);
        }
//        echo '<br/>';
//		print_r($deck);
        $this->set('deck',$deck);
//		$this->set('favoriteDeck',$favorites);
		
	}
	
	public function edit_profile($id=null){
		$user_id = $this->Auth->user('id');
		
		$profile = $this->User->find('first', array(
        'conditions' => array('User.id' => $user_id)
		));
		if(empty($profile)){
            $this->redirect(['action' => 'index']);
        }
		
		$this->set('userObj', $profile);
		$this->set('u_id', $user_id);
		
		if($this->request->is('POST')){
						
						
			if(!empty($this->request->data['User1']['upload']['name'])){
				$filename = WWW_ROOT. DS . 'profiles'.DS.$this->data['User1']['upload']['name']; 
				move_uploaded_file($this->data['User1']['upload']['tmp_name'], $filename);
				$img_name = $this->request->data['User1']['upload']['name']; 
			}else{
				$img_name = $profile['User']['img'];
			}
				
			$user = [
                'User' => [
                    'id' => $user_id,
					'firstname' => $this->request->data['User1']['firstname'],
					'lastname' => $this->request->data['User1']['lastname'],
					'img' => $img_name
				]
            ];
					

			$this->loadModel('User');
			
			if($this->User->save($user)){
				$this->Session->setFlash('edit profile success.');
				$this->redirect(['action' => 'index']);
			}else{
				$this->Session->setFlash("edit profile error");
			}
			
			//echo "<xmp>";var_dump($this->data);echo "</xmp>";

		}
		
	}
	
	public function change_password($id=null){
		$user_id = $this->Auth->user('id');
		
		$profile = $this->User->find('first', array(
        'conditions' => array('User.id' => $user_id)
		));
		
		if(empty($profile)){
            $this->redirect(['action' => 'index']);
        }
		
		$this->set('userObj', $profile);
		$this->set('u_id', $user_id);
		
		
		
		if($this->request->is('POST')){
            $data = [
                'User' => [
                    'id' => $user_id,
					'username' => $this->request->data['User']['username'],
					'password' => $this->request->data['User']['confirmpassword'],
                ]
            ];
					

			$this->loadModel('User');
			
			
		if($this->User->save($data)){
			$this->Session->setFlash('change password success.');
			$this->redirect(['action' => 'index']);
		}else{
			$this->Session->setFlash("change password error");
		}	
		}
		
	}


}
