<div class = 'row'></div>
<div class = 'row'></div>
<form action = 'adminAmendDeckToSql' method="post" >
<div class = 'row'>
	<div class ='col m6 offset-m3 s12'>
			<label> Choose deck to amend </label>
			<select class="browser-default" name = 'deck' id = 'deck'>
			<option value="" disabled selected> Please select deck </option>
			<?php 
				$link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
				$stmt = "use mnemosyne";
				$result = mysql_query($stmt);
				$stmt = "select * from `decks` order by name ASC";
				$result = mysql_query($stmt);
				$count = 1;
				while($obj = mysql_fetch_array($result)){
				?>
					<option value=<?php echo $obj['id']; ?> > <?php echo $count.")  ".$obj['name']; $count += 1; ?> </option>
			<?php } ?>
			</select>
	</div>
</div>
		<div class = 'row'>
			<div class = 'col s12  offset-m5'>
				  <button class="btn waves-effect waves-light" type="submit" name="action"> Amend
					<i class="mdi-content-send right"></i>
					</button>
        
			</div>
		</div>
		
</form>