<?php
Class AdminsController extends AppController{
    
    public $uses = ['Deck', 'Category', 'Card', 'Tag', 'User', 'DeckTag', 'FavoriteDeck', 'Score'];
    
 public function index(){
	 
	  $this->redirect(['action' => 'mainAdminPage']);
 }
 public function mainAdminPage(){
	 $this->layout = 'admin';
 }
 
 public function adminDecksManagementPage(){
	 $this->layout = 'admin';
 }
 
 public function adminFlashcardsMainPage(){
	 $this->layout = 'admin';
 }
 public function adminCategoriesMainPage(){
	  $this->layout = 'admin'; 
 }
 
 public function adminCategoriesManagePage(){
	  $this->layout = 'admin'; 
	  $check1 = $_GET['check1'];
	  $this -> set('check1',$check1);
	  $check2 = $_GET['check2'];
	  $this -> set('check2',$check2);
	  $this -> set('page',"");
 }
 
 public function adminDeleteTagsPage(){
	  $this->layout = 'admin'; 
	 $link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
	 $stmt = "use mnemosyne";
	 $result = mysql_query($stmt);
	 $stmt = "select * from `tags`";
	 $result = mysql_query($stmt);
	 $error = array();
	 $hasError = false;
	 while($obj = mysql_fetch_array($result)){
		 $i = $obj['id'];
		 if(isset($_GET[$i])){
			$word = "delete from `tags` where id = ".$i;
			$r = mysql_query($word);
			if(!$r){
				array_push($error,$obj['name']);
				$hasError = true;
			}
		 }
		 else{} 
	 }
	 $this -> set('error',$error);
	  mysql_close($link);
 }
 
 public function adminDeleteCategoriesPage(){
	  $this->layout = 'admin'; 
	 $link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
	 $stmt = "use mnemosyne";
	 $result = mysql_query($stmt);
	 $stmt = "select * from `categories`";
	 $result = mysql_query($stmt);
	 $error = array();
	 $hasError = false;
	 while($obj = mysql_fetch_array($result)){
		 $i = $obj['id'];
		 if(isset($_GET[$i])){
			$word = "delete from `categories` where id = ".$i;
			$r = mysql_query($word);
			if(!$r){
				array_push($error,$obj['name']);
				$hasError = true;
			}
		 }
		 else{} 
	 }
	  $this -> set('error',$error);
	  mysql_close($link);
	 
 }
 
 public function adminCategoriesAddToSql(){
	 $this->layout = 'admin'; 
	 $name11 = $_GET['cname11'];
	 $my_date = date("Y-m-d H:i:s");
	 $link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
	 $stmt = "use mnemosyne";
	 $result = mysql_query($stmt);
	 $stmt = "insert  into `categories` (name,created,modified) values ('$name11','$my_date','$my_date')";
	 $result = mysql_query($stmt);
	 $error = false;
	 if(!$result){
		 $error = true;
	 }
	 $this -> set('error',$error);
	 mysql_close($link);
	 
 }
 
  public function adminTagsAddToSql(){
	 $this->layout = 'admin'; 
	 $name11 = $_GET['cname12'];
	 $my_date = date("Y-m-d H:i:s");
	 $link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
	 $stmt = "use mnemosyne";
	 $result = mysql_query($stmt);
	 $stmt = "insert  into `tags` (name,created,modified) values ('$name11','$my_date','$my_date')";
	 $result = mysql_query($stmt);
	 mysql_close($link);
	 if(!$result){
		 $error = true;
	 }
	 $this -> set('error',$error);
	 
 }
 
 public function adminAmendCategoriesPage(){
	 $this->layout = 'admin';
	 $id = $_GET['adc'];
	 $msg = $_GET['catName'];
	 $my_date = date("Y-m-d H:i:s");
	 $link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
	 $stmt = "use mnemosyne";
	 $result = mysql_query($stmt);
	 $stmt = "update `categories` set name = '"."$msg"."' , modified = '"."$my_date"."' where id = '"."$id"."'";
	 $result = mysql_query($stmt);
	 $error = false;
	 if(!$result){
		 $error = true;
	 }
	 $this -> set('error',$error);
	 mysql_close($link);
	 
 }
 
  public function adminAmendTagsPage(){
	 $this->layout = 'admin';
	 $id = $_GET['adc1'];
	 $msg = $_GET['catName1'];
	 $my_date = date("Y-m-d H:i:s");
	 $link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
	 $stmt = "use mnemosyne";
	 $result = mysql_query($stmt);
	 $stmt = "update `tags` set name = '"."$msg"."' , modified = '"."$my_date"."' where id = '"."$id"."'";
	 $result = mysql_query($stmt);
	 $error = false;
	 if(!$result){
		 $error = true;
	 }
	 $this -> set('error',$error);
	 mysql_close($link);
	 
 }
 
 public function adminCreateDecksPage(){
	 	 $this->layout = 'admin';
 }
 
 public function adminCreateDecksToSql(){
	 $error = false;
	 $this->layout = 'admin'; 
	 $date = date("Y-m-d H:i:s");
	 $userid = $this -> Auth-> user('username');
	 if( (isset($_GET['ndeck']) && isset($_GET['descript']) && isset($_GET['status']) && isset($_GET['cat']) && isset($_GET['tag']))  == false){
		 $error = true;
		 echo "ee";
	 }
	 else{
	 $name = $_GET['ndeck'];
	 $des = $_GET['descript'];
	 $public = $_GET['status'];
	 $cat = $_GET['cat'];
	 $tag = $_GET['tag'];
	 $link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
	 $stmt = "use mnemosyne";
	 $result = mysql_query($stmt);
	 $stmt = "insert into `decks` (name,description,status,user_id,category_id,created,modified) values ( '$name' ,'$des','$public','$userid','$cat','$date','$date')";
	 $result = mysql_query($stmt);
	 $id = mysql_insert_id();
	 if(!$result){
		 $error = true;
	 }
	 
	 $stmt = "insert into `deck_tags` (deck_id,tag_id) values ('$id','$tag')";
	 $result = mysql_query($stmt);
	 if(!$result){
		 $error = true;
	 }
	 $this -> set("error",$error);
	 mysql_close($link);
	 }
	 
	 
	 
 }
 
 public function adminCreateCardsPage(){
	 
	 
 }
 
 public function adminAmendCardsPage(){}
 
 public function adminDeleteCardsPage(){
	 
 }
 
public function adminDeleteDecksPage(){
	$this->layout = 'admin'; 
	$_GET['page'] = "";
	$this -> set('page',"");
}

public function adminDeleteDecksToSql(){
	 $this->layout = 'admin'; 
	 $link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
	 $stmt = "use mnemosyne";
	 $result = mysql_query($stmt);
	 $stmt = "select * from `decks`";
	 $result = mysql_query($stmt);
	 $error = array();
	 $hasError = false;
	 while($obj = mysql_fetch_array($result)){
		 $i = $obj['id'];
		 if(isset($_GET[$i])){
			$word = "delete from `decks` where id = ".$i;
			$r = mysql_query($word);
			if(!$r){
				array_push($error,$obj['name']);
				$hasError = true;
			}
		 }
		 else{} 
	 }
	  $this -> set('error',$error);
	  mysql_close($link);
	
}

public function adminAmendDecksPage(){
	$this->layout = 'admin'; 
}

public function adminAmendDeckToSql(){
//	$this->layout = 'admin'; 
//	$deck_name = $_GET['deck'];
//	$name = $_GET['name1'];
//	$des = $_GET['descript'];
//	$status = $_GET['status'];
//	$cat = $_GET['cat'];
//	$error = false;
//	 $link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
//	 $stmt = "use mnemosyne";
//	 $result = mysql_query($stmt);
//	 $stmt = "update `decks` set name = '$name' , description = '$des' , status = '$status' , category_id = '$cat' where id = '$deck_name'";
//	 $result = mysql_query($stmt);
//	 if(!$result){
//		 $error = true;
//	 }
//	  $this -> set('error',$error);
//	  mysql_close($link);
    $deck_id = $_POST['deck'];
     $this->redirect(['action' => 'edit', $deck_id]);
}

public function adminCardsManagementPage(){
	$this->layout = 'admin'; 
}

public function adminBadgeManagementPage(){
	$this->layout = 'admin'; 
}

public function adminImportCVSDecksPage(){
	$this->layout = 'admin'; 
}

public function adminImportCvsToSql(){
	$this->layout = 'admin'; 
	$target_dir = "cvs/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$error = "";

	
	// Check if file already exists
	if (file_exists($target_file)) {
		$error .= "Sorry, file already exists.\n";
		$uploadOk = 0;
	}
	
	if($imageFileType != "csv" ) {
    $error .= "Sorry, only cvs files are allowed.\n";
    $uploadOk = 0;
	}
	
	if ($uploadOk == 0) {
		$error .= "Sorry, your file was not uploaded.\n";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    } else {
        $error .= "Sorry, there was an error uploading your file.\n";
    }
	}
	$this -> set('error',$error);
	$this -> set('result',$target_file);
	$this -> set('id',$this -> Auth -> user('id'));
	
}

public function adminBadgeAmendToSql(){
	$date = date("Y-m-d H:i:s");
	$this->layout = 'admin';
	$badge = $_POST['type'];
	$name = $_POST['name3'];
	$detail = $_POST['textarea1'];
	$error = "";

	
if($_FILES["fileToUpload"]["name"] != null){
	
	$target_dir = "imageForBadge/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);


$resulty = $target_file;

$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


// Check if file already exists
if (file_exists($target_file)) {
    $error .= "Sorry, file already exists.\n";
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $error .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.\n";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $error .= "Sorry, your file was not uploaded.\n";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    } else {
        $error .= "Sorry, there was an error uploading your file.\n";
    }
}


//  XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
//  XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
//  XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
//  XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
//  XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
//  XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX -->
//  XXXXX   if you want to change thumnail path concate with $resulty XXXXXXXXX -->


	$link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
	 $stmt = "use mnemosyne";
	 $result = mysql_query($stmt);


	if($name == ""){
		if($detail == ""){
			$stmt = "update `badges` set thumbnail = '$resulty' ,modified = '$date' where id = '$badge'";
			$result = mysql_query($stmt) or die("Error Found : ".mysql_error());
		}
		else{
			$stmt = "update `badges` set detail = '$detail',thumbnail = '$resulty' , modified = '$date' where id = '$badge'";
			$result = mysql_query($stmt) or die("Error Found : ".mysql_error());
		}
	}
	
	else{
		if($detail == ""){
			$stmt = "update `badges` set name = '$name',thumbnail = '$resulty' , modified = '$date' where id = '$badge'";
			$result = mysql_query($stmt) or die("Error Found : ".mysql_error());
		}
		else{
			$stmt = "update `badges` set name = '$name', detail = '$detail',thumbnail = '$resulty', modified = '$date' where id = '$badge'";
			$result = mysql_query($stmt) or die("Error Found : ".mysql_error());
		}
	}


}
else{
	$link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
	 $stmt = "use mnemosyne";
	 $result = mysql_query($stmt);
	if($name == ""){
		if($detail == ""){
			$error .= "You didn't change anything!";
		}
		else{
			$stmt = "update `badges` set detail = '$detail',modified = '$date' where id = '$badge'";
			$result = mysql_query($stmt) or die("Error Found : ".mysql_error());
		}
	}
	else{
		if($detail == ""){
			$stmt = "update `badges` set name = '$name',modified = '$date' where id = '$badge'";
			$result = mysql_query($stmt) or die("Error Found : ".mysql_error());
		}
		else{
			$stmt = "update `badges` set name = '$name', detail = '$detail',modified = '$date' where id = '$badge'";
			$result = mysql_query($stmt) or die("Error Found : ".mysql_error());
		}
	}
}

	
	$this -> set('error',$error);
	
	
	
}
    
    
    public function add() {
        $this->layout = 'admin';
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
        $this->layout = 'admin';
        $deck = $this->Deck->find('first', [
            'conditions' => ['Deck.id' => $deck_id],
            'recursive'=> -1
        ]);
    
        if(($deck['Deck']['status'] || $deck['Deck']['user_id'] != $this->Auth->User('id')) && $this->Auth->User('role') != 'a')
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
    
    public function delete($deck_id=null) {
        
    }
    
    public function stat($deck_id=null) {
        $this->layout = 'admin';
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
    
    public function importCSV() {
        $this->layout = 'admin';
        $this->__getCategories();
        
        if($this->request->is('post')) {
            $tmp_name = $this->data['Admins']['csv']['tmp_name'];
            $filename = $_SERVER['DOCUMENT_ROOT'] . '/mnemosyne/app/webroot/files/csv/' . $this->data['Admins']['csv']['name'];
            
            if(move_uploaded_file($tmp_name, $filename)) { 
                $handle = fopen($filename, "r");

                // read the 1st row as title
                $title = fgetcsv($handle);
                $titleEx = explode(":", $title[0]);
                $deck = [
                    'Category' => ['id' => $this->request->data['Admins']['category_id']], 
                    'Deck' => [
                        [
                            'name' => substr($titleEx[1],1,-1),
                            'user_id' => $this->Auth->user('id')
                        ]
                    ]
                ];
                
                if($this->Category->saveAssociated($deck, array('deep' => true))) {
                    $deck_id = $this->Deck->getLastInsertId();
                    
                    // read the 2nd row as header
                    $header = fgetcsv($handle);
                    $i = 0;
                    while (($row = fgetcsv($handle)) !== FALSE) {
                        $i++;
                        $data = array();
                        $data['Deck']['id'] = $deck_id;
                        $data['Card'][0]['sort_number'] = $i;
                        // for each header field 
                        foreach ($header as $k=>$head) {
                            $data['Card'][0][$head] = '{\'text\':\''.htmlspecialchars($row[$k]).'\'}';
                        }
                        // save the row
                        if (!$this->Deck->saveAssociated($data)) {
                            $this->Session->setFlash(__(sprintf('Row %d failed to save.',$i), true));  
                            return 1;
                        }
                    }
                    
                    fclose($handle);
                    $this->Session->setFlash("Success");  
                    $this->redirect(['action' => 'edit', $deck_id]);
                    return 0;   
                    
                } else {
                    $this->Session->setFlash("Error");  
                }
                
            }
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
?>