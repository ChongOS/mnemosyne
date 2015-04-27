<div class = 'row'></div>
<div class = 'row'>
<div class = 'col m10 offset-m1 s12'>
<?php
	if(empty($error)){
		?>
		 <p><i class = 'mdi-action-face-unlock' > </i> Delete With No ERROR ! </p>
	<?php } else{
	?>
		<table class = 'table'>
		<caption> Can't delete some categories because of being used by other table </caption>
		<thead>
		<tr>
		<th style= 'text-align:center' > name </th>
		</tr>
		</thead>
		<tbody>
		<?php for($i = 0;$i < count($error) ;$i++){ ?>
			<tr>
			<td style= 'text-align:center'> <?php echo ($i+1)." )        ".$error[$i]; ?> </td>
			</tr>
		<?php } ?>
		</tbody>
		</table>
	<?php } ?>
</div>
</div>
<div class = 'row'></div>
<div class = 'row'></div>
<div class = 'row'>
<div class = 'col offset-m5 s12'>
	<a class="waves-effect waves-light btn" href = 'adminCategoriesMainPage' > I got it !</a>
</div>
</div>
<div class = 'row'></div>
<div class = 'row'></div>