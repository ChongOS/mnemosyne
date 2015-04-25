<?php
/**
 * Created by PhpStorm.
 * User: chongos
 * Date: 4/23/15 AD
 * Time: 12:23 PM
 */

class DecksController extends AppController {

    public $uses = ['Deck', 'Category', 'Card', 'Tag', 'User'];

    public function index() {

    }

    public function add() {
        $this->__getCategories();
        
        if ($this->request->is('post')) { 

            $tags = [];
            foreach(explode(",,;",$this->request->data['Deck']['tags']) as $tag)
                $tags[] = ['Tag' => ['name' => $tag]];

            $cards = [];
            foreach(json_decode($this->request->data['Deck']['cards'], true) as $card) {
                $front = '{"'.$card['front']['type'].'":"'.$card['front']['value'].'"}';
                $back = '{"'.$card['back']['type'].'":"'.$card['back']['value'].'"}';
                $cards[] = ['front' => $front, 'back' => $back];
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
            
//            print_r($data);
            if($this->Category->saveAssociated($data, array('deep' => true))) {
                $this->Session->setFlash("Success");
                $this->redirect(['action' => 'edit', $this->Deck->getLastInsertId()]);
            } else {
                $this->Session->setFlash("Error");
            }

        }
    }
    
    public function edit($id = null) {
        
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
