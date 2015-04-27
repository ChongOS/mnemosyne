<?php 
    class FavoriteDecksController extends AppController {
   
    public $uses = ['FavoriteDeck', 'User'];
        
    public function setFavorite() {
        if($this->request->isAjax()) { 
            $id = $this->request->data('id');
            $set = $this->request->data('set');
            
            if($set) {
                if($this->FavoriteDeck->save([
                    'FavoriteDeck' => [ 'deck_id' => $id , 'user_id' => $this->Auth->User('id') ]
                ]))
                    echo 'Success, Set Favorite';
                else 
                    echo 'Error';
            } else {
                if($this->FavoriteDeck->deleteAll([
                    'FavoriteDeck.deck_id' => $id,
                    'FavoriteDeck.user_id' => $this->Auth->User('id') 
                ])) 
                    echo 'Success, Unset Favorite';
                else 
                    echo 'Error';
            }

            $this->autoRender = false;
            die();
        }   
    }

}