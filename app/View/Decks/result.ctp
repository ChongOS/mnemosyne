<?php

	echo $this->Html->css('result.css');
	echo $this->Html->script("jquery-ui.js");
	echo $this->Html->script('result.js');
	
	// echo the javascript variable(s)
	
	echo '<script> var score = ' . $score . ';';
	echo 'var isBadgeAvailable = ' . ((sizeof($badgesGranted) != 0) ? 1 : 0) . '; </script>';
	
?>

<!-- Facebook JavaScript SDK -->

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- End of Facebook JavaScript SDK -->

<!-- Badges Modal Dialog -->

<div id="badge-modal" class="modal modal-fixed-footer">
	
    <div class="modal-content">
	    
      	<h4>Badges</h4>
      	
	  	<p>You have granted the new badge(s)</p>
	  	
	  	<div id="badge-container">
		  	
		  	<?php foreach ($badgesGranted as $badge) : ?>
			  	
			  	<div class="badge-row">
		  			
		  			<?php echo $this->Html->image($badge['Badge']['thumbnail'], array('class' => 'badge-img in-line')); ?>
		  			
		  			<p>Name : <?php echo $badge['Badge']['name']; ?></p>
		  			
		  			<p>Description : <?php echo $badge['Badge']['detail']; ?></p>
		  		
			  	</div>
		  	
		  	<?php endforeach; ?>
		  	
	  	</div>
	  	
    </div>
    
    <div class="modal-footer">
	    
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">OK</a>
      
    </div>
    
</div>
  
<!-- End of Badges Modal Dialog -->

<div class="row">
	
	<div id="main-box" class="z-depth-1">
		
		<h4>
			<i class="mdi-image-style"></i> <?php echo $deckName; ?> <i>
				<!-- Facebook's share button -->
				<div class="fb-share-button" data-href="<?php echo $shareURL; ?>" data-layout="button"></div>
			</i>
		</h4>
				
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