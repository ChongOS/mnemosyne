<div class = 'row'></div>
<div class = 'row'></div>
<div class = 'row'>
	<div class = 'col offset-m3'>
		<p> Attention: .CSV file may create by microsoft excel and be important to be in form as same as shown below ! </p>
	</div>
</div>
<div class = 'row'>
	<div class = 'col offset-m3'>
		<table border = '1'>
		<thead>
			<tr>
				<th> |   name  |</th>
				<th> description  |</th>
				<th> status : 1 for publicize 0 for no   |</th>
				<th> category_id   |</th>
				<th> tag_id   |</th>

			</tr>
		</thead>
		<tbody>
			<tr>
			<td> pokemon  </td>
			<td>  quize pokemonster </td>
			<td>  1  </td>
			<td>  1  </td>
			<td>  1  </td>
			</tr>
			</tbody>
		
		</table>
	</div>
</div>

<div class = 'row'></div>
<div class = 'row'></div>

<div class = 'row' >
	<div class = 'col offset-m3' style = 'background-color:#FF3366'>
		
		<form action="adminImportCvsToSql" method="post" enctype="multipart/form-data">
		Select .cvs to upload:
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type="submit" value="Upload CVS" name="submit">
		</form>
		
	</div>
</div>