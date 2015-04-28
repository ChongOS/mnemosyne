<?php

	echo $this->Html->css('result.css');
	
?>

<div class="row">
	
	<div class="col z-depth-1">
		
		<div id="grade_pic">
		
		<?php
						
			$diff = $total_score - $score;
			
			if ($diff === 0 && $diff <= 2) {
				echo $this->Html->image('GradeA.png');
				$grade = 'A';
			} else if ($diff > 2 && $diff <= 4) {
				echo $this->Html->image('GradeB.png');
				$grade = 'B';
			} else if ($diff > 4 && $diff <= 6) {
				echo $this->Html->image('GradeC.png');
				$grade = 'C';
			} else if ($diff > 6 && $diff <= 8) {
				echo $this->Html->image('GradeD.png');
				$grade = 'D';
			} else {
				echo $this->Html->image('GradeF.png');
				$grade = 'F';
			}
	    ?>
	    
		</div>
		
		<div id="grade_name">
			
			<h4>Grade: <?php echo $grade; ?></h4>
			
		</div>
		
		<div id="user_name">
			
			<p>User: <?php echo $user_name ?></p>
			
		</div>
		
		<div id="score">
			
			<p>You score: <?php echo $score; ?></p>
			
		</div>
		
	</div>
	
</div>