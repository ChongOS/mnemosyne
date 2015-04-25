<?php

	echo $this->Html->css("review_mode.css");
	echo $this->Html->script("review_mode.js");

?>
<div class="row" id="card-container">
	<div class="top-bottom-padding-adjustment">
		<section class="col z-depth-1 card left-card">
			<p>test</p>
			<p>test</p>
			<p>test</p>
			<p>test</p>
			<button class="waves-effect waves-teal btn-flat" type="submit" name="action">Submit
				<i class="mdi-content-send right"></i>
			</button>
		</section>
		<section class="col z-depth-1 card middle-card">
			<p>test</p>
			<p>test</p>
			<p>test</p>
			<p>test</p>
			<button class="waves-effect waves-teal btn-flat" type="submit" name="action">Submit
				<i class="mdi-content-send right"></i>
			</button>
		</section>
		<section class="col z-depth-1 card right-card">
			<p>test</p>
			<p>test</p>
			<p>test</p>
			<p>test</p>
			<button class="waves-effect waves-teal btn-flat" type="submit" name="action">Submit
				<i class="mdi-content-send right"></i>
			</button>
		</section>
	</div>
</div>

<div class="row">
	<div class="col s4 offset-s4">
		<div class="center-align top-bottom-padding-adjustment">
			<a class="waves-effect waves-light btn" id="btn-back"><i class="mdi-navigation-arrow-back left"></i> Back</a>
			<a class="waves-effect waves-light btn" id="btn-next">Next <i class="mdi-navigation-arrow-forward right"></i></a>
		</div>
	</div>
</div>