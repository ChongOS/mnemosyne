<div class = 'row'></div>
<div class = 'row'></div>
<div class = 'row'>
<div class = 'col offset-m3'>
<?php 
	if($error != ""){
		echo "Error Found : <p> $error </p>";
	}
	else{
		$objCSV = fopen($result, "r");
		$date = date('Y-m-d H:i:s');
		?>
		
	<table class = 'table'>
		<thead>
			<tr>
				<th> name </th>
				<th> description </th>
				<th> status </th>
				<th> user_id </th>
				<th> category_id </th>
				<th> created </th>
				<th> modified </th>
				<th> tag_id </th>
			</tr>
		</thead>
		<tbody>
		<?php while (($objArr = fgetcsv($objCSV,1000, ",")) != FALSE) { ?>
			<tr>
			
			<?php
				echo "<td> $objArr[0] </td> <td> $objArr[1] </td> <td> $objArr[2] </td> <td> $id </td> <td> $objArr[3] </td> <td> $date </td> <td> $date </td> <td> $objArr[4] </td>";
				
					 $link = mysql_connect('fieldfirstvm.cloudapp.net','user','1234');
					$stmt = "use mnemosyne";
					$result = mysql_query($stmt);
					$stmt = "insert into `decks` (name,description,status,user_id,category_id,created,modified) values ('$objArr[0]','$objArr[1]','$objArr[2]','$id','$objArr[3]','$date','$date')";
					$result = mysql_query($stmt) or die("error".mysql_error());
					$num = mysql_insert_id();
					$stmt = "insert into `deck_tags` (deck_id,tag_id) values ('$num','$objArr[4]')";
					$result = mysql_query($stmt) or die(mysql_error());
					
				
				
				
				
			?>
			
			</tr>
			<?php } 
				fclose($objCSV);
			?>
		
		</tbody>
	
	</table>
	
<?php	
	}
	
	?>
</div>
</div>

<div class = 'row'></div>
<div class = 'row'>
<div class = 'col offset-m5'>
	<a href = 'adminImportCVSDecksPage'> <button class = 'btn' > I got it !</button> </a>
</div>
</div>
