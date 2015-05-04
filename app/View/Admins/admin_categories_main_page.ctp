<div class = 'row'> </div>
	 <div class="row">	  

	 <form class="col s12" onsubmit = 'return check()' action = 'adminCategoriesManagePage' method="get">

	 <div class = 'row'>
	 <div class = 'col m6 offset-m3 s12'>
		<label> Choose what you want to do:</label>
		<select id = 'check1' name = 'check1' class="browser-default">
		<option value="0" disabled selected>Choose ?</option>
		<option value="1"> Create </option>
		<option value="2"> Amend </option>
		<option value="3"> Delete </option>
		</select>
	</div>
	</div>
	
	 <div class = 'row'>
	 <div class = 'col m6 offset-m3 s12'>
		<label> Choose what you want to work with:</label>
		<select id = 'check2' name = 'check2' class="browser-default">
		<option value="0" disabled selected>Categories or Tags ?</option>
		<option value="1"> Categories </option>
		<option value="2"> Tags </option>
		</select>
	</div>
	</div>
	<div class = 'row'>
		<div class = 'col offset-m5 ' >
		 <button class="btn waves-effect waves-light" type="submit" name="action"> GO
		 <i class="mdi-content-send right"></i>
		 </div>
  </button>
	</div>
	
	</form>
	</div>
	
	<script language="JavaScript"> 
		function check(){
			var value = document.getElementById("check1");
			var check = value.options[value.selectedIndex].value;
			var value1 = document.getElementById("check2");
			var check1 = value.options[value.selectedIndex].value;
			if(check == "0" || check1 == "0" ){
				Materialize.toast('Please fill in form completely !', 4000);
				return false;
			}
			else{
				return true;
			}
		}
	</script> 
