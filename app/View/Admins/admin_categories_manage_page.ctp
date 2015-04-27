   <nav>
        <div class="nav-wrapper">
            <div class="container">

                <a href="#" class="brand-logo"></a>
                <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu white-text"></i></a>
                <ul class="right hide-on-med-and-down">
				<li ><a class="white-text" > FlashCards Management </a></li>
				<li ><a class="white-text" > Badges Management </a></li>
                </ul>
                <ul class="side-nav" id="mobile-demo">
                    <li>
                        <div class="nav-wrapper">
                            <form>
                                <div class="input-field">
                                    <input id="search" type="text" class="black-text" required>
                                    <label for="search"><i class="mdi-action-search black-text"></i></label>
                                </div>
                            </form>
                        </div>
                    </li>
                    <li><hr/></li>
                    <li><a>Profile</a></li>
                    <li><hr/></li>
					<li><a> FlashCards Management</a></li>
                    <li><a> Badges Management </a></li>
                </ul>
            </div>
        </div>
    </nav>
<?php 
	if($check1 == "1" && $check2 == "1"){
		?>
		<form onsubmit = 'return check11()' action = 'adminCategoriesAddToSql' method='get'>
		
		<div class = 'row'> </div>
		<div class = 'row'>
		</div>
		<div class = 'row'>
			 <div class="input-field col m6 offset-m3 s12">
			<input id = 'name11' name = 'cname11' placeholder="fill category's name"  type="text" class="validate">
			<label for="first_name"><i class='mdi-editor-border-color' ></i> Category's name  </label>
			</div>
		</div>
		
		<div class = 'row'>
			<div class = 'col m6 offset-m3 s12'> <i class = 'mdi-av-timer'> </i> Date of Creation : <?php echo date("d-m-Y H:i:s"); ?></p></div>
		</div>
		<div class = 'row'>
		<div class= 'col offset-m5'>
			<button class="btn waves-effect waves-light" type="submit" name="action"> Create
			<i class="mdi-content-send right"></i>
			</button>
        
		</div>
		</div>
		
		</form>
		
<?php	}  elseif ($check1 == "1" && $check2 = "2"){ ?>
		<form onsubmit = 'return check12()' action = 'adminTagsAddToSql' method='get'>
		
		<div class = 'row'> </div>
		<div class = 'row'>
		</div>
		<div class = 'row'>
			 <div class="input-field col m6 offset-m3 s12">
			<input id = 'name12' name = 'cname12' placeholder="fill Tag's name"  type="text" class="validate">
			<label for="first_name"><i class='mdi-editor-border-color' ></i> Tag's name  </label>
			</div>
		</div>
		
		<div class = 'row'>
			<div class = 'col m6 offset-m3 s12'> <i class = 'mdi-av-timer'> </i> Date of Creation : <?php echo date("d-m-Y H:i:s"); ?></p></div>
		</div>
		<div class = 'row'>
		<div class= 'col offset-m5'>
			<button class="btn waves-effect waves-light" type="submit" name="action"> Create
			<i class="mdi-content-send right"></i>
			</button>
        
		</div>
		</div>
		
		</form>
		
		
		
		<?php } elseif($check1 == "3" && $check2 == "1"){ 
		
			//doing pagination  thk:http://www.thaicreate.com/php/php-mysql-list-record-paging.html
			
					$link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
					$stmt = "use mnemosyne";
					$result = mysql_query($stmt);
					$stmt = "select * from `categories` order by name ASC";
					$erows = mysql_query($stmt);
					$rows = mysql_num_rows($erows);
					$perpage = 7;
					if(isset($_GET['page'])){
					$page = $_GET['page'];
					}
					if($page == ""){
						$page = 1;
					}
					$page = (int)$page;
					$beforePage = $page-1;
					$nextPage = $page + 1;
					$pageStart = ($perpage*$page) - $perpage;
					if($rows <= $perpage){
						$num_page = 1;
					}
					elseif( ($rows % $perpage )== 0 ){
						$num_page = ($rows / $perpage)+1;

					}
					else{
					    $num_page = ($rows / $perpage)+1;
						$num_page = (int)$num_page;
					}
					$stmt = $stmt." LIMIT $pageStart , $perpage";
					$result = mysql_query($stmt) or die("err :".$stmt);
					?>
					<form onsubmit = 'return check31()' action = 'adminDeleteCategoriesPage' method = 'get'>
					<div class = 'row'></div>
					<div class = 'row'></div>
					<div class = 'row'>
					<div class = 'col m10 offset-m1 '>
					<table class = 'table-striped'>
						<caption> check in the box to delete categories </caption>
						<thead>
						<tr>
					
						<th> name </th>
						<th> date of creation </th>
						<th> date of modification </th>
						</tr>
						</thead>
						<tbody>
						<?php while($obj = mysql_fetch_array($result)){
							?>
							<tr>
							<td> <p>
									<input type="checkbox" name=<?php echo $obj['id']; ?> id=<?php echo $obj['id']; ?> />
									<label for= <?php echo $obj['id']; ?> > <?php echo $obj['name'] ?> </label>
							</p></td>
							
							<td> <?php echo $obj['created'] ?> </td>
							<td> <?php echo $obj['modified'] ?> </td>
							</tr>
						<?php
						}
						?>
						</tbody>
					</table>
					
					</div>
					</div>
					
					<div class = 'row'>
					<div class = 'col offset-m5'>
						<button class="btn waves-effect waves-light" type="submit" name="action">Delete
						<i class="mdi-action-delete right"></i>
						</button>
					</div>
					</div>
					</form>
					<div class = 'row'>
					<div class = 'col offset-m5'>
					<?php if($beforePage){
						echo " <a href='adminCategoriesManagePage?check2=1&check1=3&page=$beforePage'> << Back </a> ";
					}
					for($i=1; $i <= $num_page; $i++){
							if($i != $page){
								echo "[ <a href='adminCategoriesManagePage?check2=1&check1=3&page=$i' >$i </a> ]";
							}
							else{
							echo "<b> $i </b>";
							}
							}
							if($page!=$num_page){
							echo " <a href ='adminCategoriesManagePage?check2=1&check1=3&page=$page+1'> Next>> </a> ";
							}
							mysql_close($link);
							?>
					</div>
					</div>
					
		<?php			
			//end do 
		
		} elseif($check1 == "3" && $check2 == "2"){ 
		
			//doing pagination  thk:http://www.thaicreate.com/php/php-mysql-list-record-paging.html
			
					$link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
					$stmt = "use mnemosyne";
					$result = mysql_query($stmt);
					$stmt = "select * from `tags` order by name ASC";
					$erows = mysql_query($stmt);
					$rows = mysql_num_rows($erows);
					$perpage = 7;
					if(isset($_GET['page'])){
					$page = $_GET['page'];
					}
					if($page == ""){
						$page = 1;
					}
					$page = (int)$page;
					$beforePage = $page-1;
					$nextPage = $page + 1;
					$pageStart = ($perpage*$page) - $perpage;
					if($rows <= $perpage){
						$num_page = 1;
					}
					elseif( ($rows % $perpage )== 0 ){
						$num_page = ($rows / $perpage)+1;

					}
					else{
					    $num_page = ($rows / $perpage)+1;
						$num_page = (int)$num_page;
					}
					$stmt = $stmt." LIMIT $pageStart , $perpage";
					$result = mysql_query($stmt) or die("err :".$stmt);
					?>
					<form onsubmit = 'return check32()' action = 'adminDeleteTagsPage' method = 'get'>
					<div class = 'row'></div>
					<div class = 'row'></div>
					<div class = 'row'>
					<div class = 'col m10 offset-m1 '>
					<table class = 'table-striped'>
						<caption> check in the box to delete tags </caption>
						<thead>
						<tr>
					
						<th> name </th>
						<th> date of creation </th>
						<th> date of modification </th>
						</tr>
						</thead>
						<tbody>
						<?php while($obj = mysql_fetch_array($result)){
							?>
							<tr>
							<td> <p>
									<input type="checkbox" name=<?php echo $obj['id']; ?> id=<?php echo $obj['id']; ?> />
									<label for= <?php echo $obj['id']; ?> > <?php echo $obj['name'] ?> </label>
							</p></td>
							
							<td> <?php echo $obj['created'] ?> </td>
							<td> <?php echo $obj['modified'] ?> </td>
							</tr>
						<?php
						}
						?>
						</tbody>
					</table>
					
					</div>
					</div>
					
					<div class = 'row'>
					<div class = 'col offset-m5'>
						<button class="btn waves-effect waves-light" type="submit" name="action">Delete
						<i class="mdi-action-delete right"></i>
						</button>
					</div>
					</div>
					</form>
					<div class = 'row'>
					<div class = 'col offset-m5'>
					<?php if($beforePage){
						echo " <a href='adminCategoriesManagePage?check2=2&check1=3&page=$beforePage'> << Back </a> ";
					}
					for($i=1; $i <= $num_page; $i++){
							if($i != $page){
								echo "[ <a href='adminCategoriesManagePage?check2=2&check1=3&page=$i' >$i </a> ]";
							}
							else{
							echo "<b> $i </b>";
							}
							}
							if($page!=$num_page){
							echo " <a href ='adminCategoriesManagePage?check2=2&check1=3&page=$page+1'> Next>> </a> ";
							}
							mysql_close($link);
							?>
					</div>
					</div>
					
		<?php			
			//end do 
		} 
		elseif ($check1 == "2" && $check2 == "1"){  
		?>
		
			<form onsubmit = 'return check21()' action = 'adminAmendCategoriesPage' method = 'get'>		
			<div class = 'row'></div>
			<div class = 'row'></div>
			<div class = 'row'> 
			
				<div class="col s12 offset-m3 col m5">
				<label> Please select what you want to correct : </label>
				<select class="browser-default" id = 'adc' name = 'adc' >
				<option value="" disabled selected>Choose your option</option>
				<?php 
					 $link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
					$stmt = "use mnemosyne";
					$result = mysql_query($stmt);
					$stmt = "select * from `categories` order by name ASC";
					$result = mysql_query($stmt) or die(mysql_error());
					$count = 1;
					while($obj = mysql_fetch_array($result)){ ?> 
							<option value=<?php echo $obj['id']; ?> > <?php echo $count." )  ".$obj['name']; $count += 1; ?> </option> <?php } ?>

				</select>
				
			</div>
			</div>
			<div class = 'row'></div>
		<div class = 'row'> 
				<div class="input-field col s12 m6 offset-m3">
				<input placeholder="fill new category's name" name = "catName" id="catName" type="text" class="validate">
				<label for="catName"> New category's name </label>
				</div>
			<div class = 'row'>
			<div class = 'col offset-m3'>
				<p> Date of modification : <?php echo date("Y-m-d H:i:s") ?> </p>
			</div>
			</div>
			
			<div class = 'row'>
			<div class = 'col offset-m5'>
				<button class="btn waves-effect waves-light" type="submit" name="action"> Amend
				<i class="mdi-content-send right"></i>
				</button>
			</div>
			</div>
		</div>
</form>


		<?php  }  elseif($check1 == "2" && $check2 == "2"){  
		?>
		
			<form onsubmit = 'return check22()' action = 'adminAmendTagsPage' method = 'get'>		
			<div class = 'row'></div>
			<div class = 'row'></div>
			<div class = 'row'> 
			
				<div class="col s12 offset-m3 col m5">
				<label> Please select what you want to correct : </label>
				<select class="browser-default" id = 'adc1' name = 'adc1' >
				<option value="" disabled selected>Choose your option</option>
				<?php 
					 $link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
					$stmt = "use mnemosyne";
					$result = mysql_query($stmt);
					$stmt = "select * from `tags` order by name ASC";
					$result = mysql_query($stmt) or die(mysql_error());
					$count = 1;
					while($obj = mysql_fetch_array($result)){ ?> 
							<option value=<?php echo $obj['id']; ?> > <?php echo $count." )  ".$obj['name']; $count += 1; ?> </option> <?php } ?>

				</select>
				
			</div>
			</div>
			<div class = 'row'></div>
		<div class = 'row'> 
				<div class="input-field col s12 m6 offset-m3">
				<input placeholder="fill new category's name" name = "catName1" id="catName1" type="text" class="validate">
				<label for="catName"> New Tag's name </label>
				</div>
			<div class = 'row'>
			<div class = 'col offset-m3'>
				<p> Date of modification : <?php echo date("Y-m-d H:i:s") ?> </p>
			</div>
			</div>
			
			<div class = 'row'>
			<div class = 'col offset-m5'>
				<button class="btn waves-effect waves-light" type="submit" name="action"> Amend
				<i class="mdi-content-send right"></i>
				</button>
			</div>
			</div>
		</div>
</form>
<?php } ?>
					


	<script language="JavaScript"> 
	
		function check11(){
			var value = document.getElementById("name11").value;
			if(value == "" ){
				Materialize.toast('Please fill in form completely !', 4000);
				return false;
			}
			else{
				return true;
			}
		}
				function check12(){
			var value = document.getElementById("name12").value;
			if(value == "" ){
			
				Materialize.toast('Please fill in form completely !', 4000);
				return false;
			}
			else{
				return true;
			}
		}
		
		function check31(){
			var ans = confirm("Confirm to delete");
			if(ans == true){
				return true;
			}
			else{
				return false;
			}
		}
		
		function check32(){
			var ans = confirm("Confirm to delete");
			if(ans == true){
				return true;
			}
			else{
				return false;
			}
		}
		
		function check21(){
				alert("dfsd");
				var c = document.getElementById("catName").value;
				var d = document.getElementById("adc").value;
				
				if(c == "" or d == ""){
					Materialize.toast('Please fill in form completely !', 4000);
					return false;
				}
				else{
			var ans = confirm("Confirm to delete");
			if(ans == true){
				return true;
			}
			else{
				return false;
			}
			}
		}
		
				function check22(){
				alert("dfsd");
				var c = document.getElementById("catName1").value;
				var d = document.getElementById("adc1").value;
				
				if(c == "" or d == ""){
					Materialize.toast('Please fill in form completely !', 4000);
					return false;
				}
				else{
			var ans = confirm("Confirm to delete");
			if(ans == true){
				return true;
			}
			else{
				return false;
			}
			}
		}
		
	</script> 

