<div class = 'row'></div>
<div class = 'row'></div>

<form = onsubmit = 'return check()' action = 'adminBadgeAmendToSql' method = 'get'>
<div class = 'row'>
<div class = 'col m6 offset-m3 s12'>
	<label> Choose Badge </label>
    <select class="browser-default" id = 'type' name = 'type'>
      <option value="" disabled selected> Choose badge </option>
	  <?php 
			$link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
			$stmt = "use mnemosyne";
			$result = mysql_query($stmt);
			$stmt = 'select * from `badges` order by name ASC';
			$result = mysql_query($stmt);
			while($obj = mysql_fetch_array($result)){ ?>
				<option value= <?php echo $obj['id']; ?> > <?php echo $obj['name']; ?> </option>
				<?php } ?>
			</select>
	
</div>
</div>

 <div class="row">
        <div class="input-field col s12 m6 offset-m3">
          <input placeholder="Fill new name or Ignore for no update" id="name3" name = 'name3' type="text" class="validate">
          <label for="name3"> Badge's name </label>
        </div>
      </div>

      <div class="row">
        <div class="input-field col s12 m6 offset-m3">
          <textarea placeholder="Fill new description or Ignore for no update" id="textarea1" name = 'textarea1' class="materialize-textarea"></textarea>
          <label for="textarea1"> detial </label>
        </div>
      </div>
	  
	  <div class = 'row'>
	  <div class = 'col s12 m6 offset-m3'>
	  <div class="file-field input-field">
      <input id = 'input' placeholder="choose new .jpg  or Ignore for no update" name = 'input' class="file-path validate" type="text"/>
      <div class="btn">
        <span>File</span>
        <input type="file" />
      </div>
    </div>
	</div>
	  </div>
	  
	  <div class = 'row'>
		<div class = 'col offset-m5'>
			  <button class="btn waves-effect waves-light" type="submit" name="action"> Amend
				<i class="mdi-content-send right"></i>
				</button>
		</div>
	  </div>
  </form>
  

  <script language="JavaScript"> 
  
	function check(){
		var badge = document.getElementById('type').value
		if(badge == ""){
			Materialize.toast('Please choose badge to correct !', 4000);
			return false;
		}
		else{
			return true;
		}
	}
  
  </script>
  