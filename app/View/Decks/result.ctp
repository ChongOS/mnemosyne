<?php

	echo $this->Html->css('result.css');
	echo $this->Html->script("jquery-ui.js");
	echo $this->Html->script('result.js');
	
	// echo the javascript variable(s)
	
	echo '<script> var score = ' . $score . '; </script>';
	
?>

<div class="row">
	
	<div id="main-box" class="z-depth-1">
		
		<h4><i class="mdi-image-style"></i> <?php echo $deckName; ?></h4>
		
		<div id="score-container">
			
			<div id="left">
		
				<h5 id="current-score">Score : 0</h5>
			
			</div>
		
			<div id="right">
				
				<h5 id="last-score">Last time : <?php echo (isset($scoreOnThisDeck[0]['Score']['score']) ? $scoreOnThisDeck[0]['Score']['score'] : 0); ?></h5>
				
			</div>
		
		</div>
		
		<h6 id="score-log">Score log :</h6>
		
		<table class="bordered striped hovered">
			
			<thead>
				
				<th>
					Score
				</th>
				
				<th>
					Played on
				</th>
				
			</thead>
			
			<tbody>
				
				<?php foreach ($scoreOnThisDeck as $score): ?>
				
					<tr>
						
						<td>
							
							<?php echo $score['Score']['score']; ?>
							
						</td>
						
						<td>
							
							<?php echo $score['Score']['created']; ?>
							
						</td>
						
					</tr>
					
				<?php endforeach; ?>
				
			</tbody>
			
		</table>
		
	</div>
	
</div>