<?php
/**
 * Created by PhpStorm.
 * User: chongos
 * Date: 4/23/15 AD
 * Time: 12:23 PM
 */

class DecksController extends AppController {

    public $uses = ['Deck', 'Category', 'Card', 'Tag', 'User', 'DeckTag', 'FavoriteDeck', 'Score'];

    public function index() {
        $this->__getCategories();
    }
    
    public function category($category_id = null) {
        $this->__getCategories();
        $this->set('category_id', $category_id);
        $decks = $this->Deck->find('all', [
            'conditions' => ['Deck.status' => 1,'Category.id' => $category_id],
            'recursive'=> 1,
        ]);
        
        $tags = $this->Tag->find('list', [
            'recursive'=> 1,
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
        
        if ($this->request->is('post')) { 
            $tags = [];
            foreach(explode(",,;",$this->request->data['Deck']['tags']) as $tag)
                $tags[] = ['Tag' => ['name' => $tag]];

            $cards = [];
            $count = 1;
            foreach(json_decode($this->request->data['Deck']['cards'], true) as $card) {
                $front = '{\''.$card['front']['type'].'\':\''.$card['front']['value'].'\'}';
                $back = '{\''.$card['back']['type'].'\':\''.$card['back']['value'].'\'}';
                $cards[] = ['front' => $front, 'back' => $back, 'sort_number' => $count];
                $count++;
            }
            
            $data = [
                'Category' => ['id' => $this->request->data['Deck']['category_id']],
                'Deck' => [
                    [
                        'name' => $this->request->data['Deck']['name'],
                        'description' => $this->request->data['Deck']['description'],
                        'user_id' => $this->Auth->user('id'),
                        'Card' => $cards,
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
        
        // Published will redirect
        if($deck['Deck']['status'])
            $this->redirect(['action' => 'stat', $deck_id]);
        
        $cards = $this->Card->find('all', [
            'conditions' => ['Card.deck_id' => $deck_id],
            'order' => ['Card.sort_number'],
            'fields' => ['Card.id', 'Card.front', 'Card.back', 'Card.sort_number']
        ]);
        $this->set('cards', json_encode($cards));
        $this->__getCategories();
        $this->set('deck', $deck);
        $this->set('tags', $this->__getTags($deck_id));
        
        if ($this->request->is('post')) { 
            $tags = [];
            foreach(explode(",,;",$this->request->data['Deck']['tags']) as $tag)
                $tags[] = ['Tag' => ['name' => $tag]];
            $data = [
                'Category' => ['id' => $this->request->data['Deck']['category_id']],
                'Deck' => [
                    [  
                        'id' => $deck_id,
                        'name' => $this->request->data['Deck']['name'],
                        'description' => $this->request->data['Deck']['description'],
                        'status' => $this->request->data['Deck']['status'],
                        'Card' => json_decode($this->request->data['Deck']['cardOrder'], true),
//                        'DeckTag' => $tags
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
        }
    }
    
    public function stat($deck_id=null) {
        $favoruteDeck = $this->FavoriteDeck->find('all', [
            'conditions' => ['deck_id' => $deck_id],
            'recursive' => 0,
            'fields' => [
                'User.id', 'User.username'
            ]
        ]);
        $this->set('favoriteDeck',$favoruteDeck);
        
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
    
    function __getTags($deck_id) {
        $tags = $this->DeckTag->find('all', [
            'conditions' => ['DeckTag.deck_id' => $deck_id],
            'fields' => ['Tag.name']
        ]);
        $tagStr = '';
        foreach($tags as $tag)
            $tagStr .= $tag['Tag']['name'].',,;';
        return substr($tagStr, 0, -3);
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
