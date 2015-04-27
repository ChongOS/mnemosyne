<?php					
					$link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
					$stmt = "use mnemosyne";
					$result = mysql_query($stmt);
					$stmt = "select * from `decks` order by name ASC";
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
					<form onsubmit = '#' action = 'adminDeleteDecksToSql' method = 'get'>
					<div class = 'row'></div>
					<div class = 'row'></div>
					<div class = 'row'>
					<div class = 'col m10 offset-m1 '>
					<table class = 'table-striped'>
						<caption> check in the box to delete decks </caption>
						<thead>
						<tr>
					
						<th> name </th>
						<th> description </th>
						<th> status </th>
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
							
							<td> <?php echo $obj['description'] ?> </td>
							<td> <?php $for_print = ""; if($obj['status'] == 1){ $for_print = "publicized"; } else{ $for_print = "not publicized"; } echo $for_print; ?> </td>
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
						echo " <a href='adminDeleteDecksPage?page=$beforePage'> << Back </a> ";
					}
					for($i=1; $i <= $num_page; $i++){
							if($i != $page){
								echo "[ <a href='adminDeleteDecksPage?page=$i' >$i </a> ]";
							}
							else{
							echo "<b> $i </b>";
							}
							}
							if($page!=$num_page){
							echo " <a href ='adminDeleteDecksPage?page=$page+1'> Next>> </a> ";
							}
							mysql_close($link);
							?>
					</div>
					</div>
					