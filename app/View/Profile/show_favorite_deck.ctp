 
    <div class="container">
        <div class="row">
            <div class="col s12 m3 l2">
                <div class="col s4 offset-s4 m12">
					<br>
					<?php echo $this->Html->image('star.jpg', ['class' => 'circle responsive-img']) ?>
                </div>
            </div>
			<br><br>
			<div class="col s12 m6 12">
				<h4>My Favorite Flashcard decks</h4>
			</div>
        </div>
		
		<div class="row">
		<div class="col s12 m10">
			<div class="row">
			<?php 
            $i = 0;
			foreach ($deck as $key => $deck): ?>
				<div class="col s12">
					<div class="card-panel">
						<div class="card-title">
							<h5>
							<?php echo $this->Html->link(
								$deck['Deck']['name'],
									[
										'controller' => 'decks',
										'action' => 'learnMode',
										$deck['Deck']['id']
									]
								); ?>
							</h5>
						</div>
						<div class="card-content">
							
							<h6><b><?php echo $deck['Deck']['description']; ?></b></h6>
							<h6>
								Create by: <?php echo $this->Html->link(
								$deck['User']['username'],
									[
										'action' => 'profile',
										$deck['User']['id']
									]
								); ?> 
							</h6>
							<h6>
								Created: <?php echo $deck['Deck']['created']; ?> 
							</h6>
								
							<span class="right main-theme-text">
								<?php echo $this->Html->link(
									'Test',
										[
											'controller' => 'decks',
											'action' => 'reviewMode',
											$deck['Deck']['id']
										],
										[
											'class' => 'main-theme-text'
										]
									); 
								?>
								<i class="mdi-navigation-arrow-forward right"></i>
							</span>
							<br/>
						</div>
					</div>
				</div>
			<?php $i++; endforeach; ?>
			</div>
		
		</div>
		</div>
	</div>
	
 <script type="text/javascript">

    $(document).ready(function(){
        $('.collapsible').collapsible({
            accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
        });
    });
    
    function setFavorite(card_id) {
        var id = card_id.substr(4);
        var set = $('#'+card_id).is(':checked') ? 1 : 0;
//        var toggle = $('#'+card_id).checked == "checked" ? '' : "checked";
        $.ajax({
            url: '/mnemosyne/favorite_decks/setFavorite/',
            type: 'POST',
            data: {
                'id' : id,
                'set' : set
            },
            success: function(data) {
                Materialize.toast('<h5>'+data+'</h5>', 2000);
            }
        });
    }
    
</script>   
