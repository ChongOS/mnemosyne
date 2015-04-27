 
    <div class="container">
        <div class="row">
            <div class="col s12 m3 l2">
                <div class="col s4 offset-s4 m12">
					<br>
                    <?php echo $this->Html->image('images.jpg', ['class' => 'circle responsive-img']) ?>
                </div>
            </div>
			<br><br>
			<div class="col s12 m6 12">
				<h4>My Flashcard decks created</h4>
			</div>
        </div>
		
		<div class="row">
		<div class="col s12 m10">
			<div class="row">
			<?php foreach ($createdDeck as $deck): ?>
				<div class="col s12 m5">
					<div class="card #f4ff81 lime accent-1">
					<div class="card-content pink-text">
						<h6><?php
							echo '<i class="mdi-action-wallet-giftcard" ></i> ' . $deck['Deck']['name'];
						?>
						<span class="badge pull-right">
							<?php
								echo $this->Html->link(
									'edit  ',
									 [
										 'controller' => 'decks',
										 'action' => 'edit',
										 $deck['Deck']['id']
									 ], [
										 'escape' => FALSE
									 ]
								);
								 
							?>
						</span></h6>
						<h6 class="brown-text">Description.</h6>
						<p><?php
							echo $deck['Deck']['description'];
						?></p>
					</div>
					<div class="card-action">
						
						<?php
                            echo $this->Html->link('LEARN', 
                            [
                                'controller' => 'decks',
                                'action' => 'learnMode',
                                $deck['Deck']['id']
                            ],[
                                'class' => 'waves-effect waves-light btn red accent-1 white-text'
								//'onclick' => 'location.href=\'/rentmyride/users/index/\';',
                            ]);
						
                            echo $this->Html->link('TEST', 
                            [
                                'controller' => 'decks',
                                'action' => 'reviewMode',
                                $deck['Deck']['id']
                            ],[
                                'class' => 'waves-effect waves-light btn red accent-1 white-text'
								//'onclick' => 'location.href=\'/rentmyride/users/index/\';',
                            ]);
						?>
						
					</div>
					
					</div>
				</div>
			<?php endforeach; ?>
			</div>
		
		</div>
		</div>
	</div>
	