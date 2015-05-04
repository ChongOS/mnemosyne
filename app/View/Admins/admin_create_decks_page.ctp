<div class = 'row'></div>
<div class = 'row'>
	<form onsubmit = 'return check()' action = 'adminCreateDecksToSql' method = 'get'>
		<div class = 'row'>
			<div class="input-field col s12 m6 offset-m3">
			<input placeholder="fill deck's name" name = 'ndeck' id="ndeck" type="text" class="validate">
			<label for="ndeck"> Deck's name </label>
			</div>
		</div>
		<div class = 'row'>
		<div class = 'col offset-m3 s12'>
			<label for="descript"> Deck's description </label>
		</div>
		<div class = 'row col s12'>
			<textarea rows="3" class = 'col m6 offset-m3 s12' name = 'descript' id = 'descript' ></textarea>
		</div>
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
		<div class = 'row'>
		<div class = 'col m6 offset-m3 s12'>
			<label> Tag </label>
			<select class="browser-default" name = 'tag' id = 'tag'>
			<option value="" disabled selected>choose tag </option>
			<?php 
					 $link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
					$stmt = "use mnemosyne";
					$result = mysql_query($stmt);
					$stmt = "select * from `tags` order by name ASC";
					$result = mysql_query($stmt);
					$count = 1;
					while($obj = mysql_fetch_array($result)){
					?>
						<option value=<?php echo $obj['id'] ?> > <?php echo $count." )  ".$obj['name']; $count += 1; ?> </option>
					
					<?php }  mysql_close($link); ?>
					</select>
		</div>
		</div>
		<div class = 'row'>
			<div class = 'col s12 m6 offset-m3'>
				<p> <i class = 'mdi-action-schedule'></i> Date of Creation : <?php echo date('Y-m-d H:i:s'); ?> </p>
			</div>
		</div>
		<div class = 'row'>
			<div class = 'col offset-m5'>
				<button class="btn waves-effect waves-light" type="submit" name="action"> Create
				<i class="mdi-content-send right"></i>
				</button>
			</div>
		</div>
	</form>
</div>

<script>

	function check(){
		var a1 = document.getElementById("tag").value;
		var a2 = document.getElementById("cat").value;
		var a3 = document.getElementById("ndeck").value;
		var a4 = document.getElementById("descript").value;
		var a5 = document.getElementById("status").value;
		if(a1 == "" || a2 == "" || a3 == "" || a4 == ""|| a5 == "" ){
			Materialize.toast('Please fill in form completely !', 4000)
			return false;
		}
		else{
			return true;
		}
	
	}
</script>