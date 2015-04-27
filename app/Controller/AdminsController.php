<?php
Class AdminsController extends AppController{
 public function index(){
	 
	  $this->redirect(['action' => 'mainAdminPage']);
 }
 public function mainAdminPage(){
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
	 $stmt = "insert into `decks` (name,description,status,user_id,category_id,created,modified) values ( '$name' ,'$des','$public','45','$cat','$date','$date')";
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
	$this->layout = 'admin'; 
	$deck_name = $_GET['deck'];
	$name = $_GET['name1'];
	$des = $_GET['descript'];
	$status = $_GET['status'];
	$cat = $_GET['cat'];
	$error = false;
	 $link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
	 $stmt = "use mnemosyne";
	 $result = mysql_query($stmt);
	 $stmt = "update `decks` set name = '$name' , description = '$des' , status = '$status' , category_id = '$cat' where id = '$deck_name'";
	 $result = mysql_query($stmt);
	 if(!$result){
		 $error = true;
	 }
	  $this -> set('error',$error);
	  mysql_close($link);
	
}

public function adminCardsManagementPage(){
	$this->layout = 'admin'; 
}

public function adminBadgeManagementPage(){
	$this->layout = 'admin'; 
}

public function adminBadgeAmendToSql(){
	$this->layout = 'admin';
	$badge = $_GET['type'];
	$name3 = $_GET['name3'];
	$txa = $_GET['textarea1'];
	$input = $_GET['input'];
	
	
	
	
}

}
?>