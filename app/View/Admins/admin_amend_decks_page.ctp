<div class = 'row'></div>
<div class = 'row'></div>
<form action = 'adminAmendDeckToSql' onsubmit = '#' >
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
	<div class="input-field col s12 m6 offset-m3">
          <input placeholder="Fill new deck's name" id="name1" name = 'name1' type="text" class="validate">
          <label for="name1">Deck's name</label>
    </div>
</div>
		<div class = 'row'>
		<div class = 'col offset-m3 s12'>
			<label for="descript"> Deck's description </label>
		</div>
		</div>
		<div class = 'row col s12'>
			<textarea rows="3" class = 'col m6 offset-m3 s12' name = 'descript' id = 'descript' ></textarea>
		</div>
		
		<div class = 'row'>
			<div class ='col m6 offset-m3 s12'>
			<label> publicizing </label>
			<select class="browser-default" name = 'status' id = 'status'>
			<option value="" disabled selected>Do you want to publicize ?</option>
			<option value="1"> yes </option>
			<option value="0"> no </option>
			</select>
			</div>
		</div>
		
		<div class = 'row'>
		<div class = 'col m6 offset-m3 s12' >
			<label> Category </label>
			<select class="browser-default" name = 'cat' id = 'cat'>
			<option value="" disabled selected>choose category </option>
			<?php 
					 $link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
					$stmt = "use mnemosyne";
					$result = mysql_query($stmt);
					$stmt = "select * from `categories` order by name ASC";
					$result = mysql_query($stmt);
					$count = 1;
					while($obj = mysql_fetch_array($result)){
					?>
						<option value=<?php echo $obj['id'] ?> > <?php echo $count." )  ".$obj['name']; $count += 1; ?> </option>
					
					<?php }  mysql_close($link); ?>
					</select>
		</div>
		</div>
		<div class= 'row'>
			<div class = 'col s12 m6 offset-m3'>
			<p> <i class = 'mdi-action-schedule' ></i> Date of Modification : <?php echo date('Y-m-d H:i:s'); ?> </p>
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