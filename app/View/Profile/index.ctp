<div class="container">
    <div class="row">
        <div class="col s12 m3 l2">
            <div class="col s4 offset-s4 m12">
<!--                <img src="images/user.jpg" alt="" class="circle responsive-img">-->
                <?php echo $this->Html->image('user.jpg', ['class' => 'circle responsive-img']) ?>
            </div>
        </div>

        <div class="col s12 m9 l10 text-center-s text-left-m">
            <h5 class="black-text col-s12">
				<?php
					echo $userObj['User']['firstname'],"  ",$userObj['User']['lastname'];						
				?>
            </h5>
            <p class="black-text col-s12">
				<?php $countCreate = count($createdDeck);
					  $countFavorite = count($favoriteDeck);
				?>
				
				<?php
					 echo $this->Html->link(
						 'Flashcard Decks Created: '.$countCreate,
						 [
							 'controller' => 'profile',
							 'action' => 'show_created_deck',
							 $userObj['User']['id']
						 ], [
							 'escape' => FALSE
						 ]
					 );
					 
				?>
				<br/>
				
				<?php
					 echo $this->Html->link(
						 'Favorite Flashcard Decks: '.$countFavorite,
						 [
							 'controller' => 'profile',
							 'action' => 'show_favorite_deck',
							 $userObj['User']['id']
						 ], [
							 'escape' => FALSE
						 ]
					 );
				?>
				<br/>
				
                Joined: <?php echo $userObj['User']['created'] ?><br/>
                Last Visit: <?php echo $userObj['User']['modified'] ?><br/>
            </p>
        </div>
    </div>
</div>

<!--
<div class="row hide-on-med-and-up">

    <ul class="collapsible" data-collapsible="accordion">
        <li>
            <div class="collapsible-header"><i class="mdi-action-credit-card"></i>Flashcards</div>
            <div class="collapsible-body">
                <p>Flashcards m</p>
            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="mdi-action-info"></i>Setting</div>
            <div class="collapsible-body">
                <p>Setting</p>
            </div>
        </li>
        <li>
            <div class="collapsible-header"><i class="mdi-action-toc"></i>Achievements</div>
            <div class="collapsible-body">
                <p>Achievements</p>
            </div>
        </li>
    </ul>
</div>
-->

<div class="row white hide-on-small-only">
    <div class="container">
        <div class="col m3">
            <ul class="nav nav-tabs tabs-left">
                <li class="active"><a href="#flashcards" class="waves-effect waves-light btn-flat" data-toggle="tab"><b>Flashcards</b></a></li>
                <li><a href="#setting" class="waves-effect waves-light btn-flat" data-toggle="tab"><b>Setting</b></a></li>
                <li><a href="#achievements" class="waves-effect waves-light btn-flat" data-toggle="tab"><b>Achievements</b></a></li>
            </ul>

        </div>
        <div class="col m9">
            <div class="tab-content">
                <div class="tab-pane active" id="flashcards">

						<div class="row">
						<?php 
						foreach ($deckShow as $deck): 
							foreach($favoriteDeck as $fav):
								if($fav['FavoriteDeck']['id']==$deck['Deck']['id']){
									$iclass = 'mdi-action-stars brown-text';
								}
								else{ $iclass = null;}
							endforeach;	
						?>
										
							<div class="col s12 m5">
								<div class="card #f4ff81 lime accent-1">
								<div class="card-content pink-text">
									<?php
										echo '<i class="mdi-action-wallet-giftcard" ></i> ' . $deck['Deck']['name'];
										
									?>
									<span class="pull-right"><i class=$iclass></i></span>
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
								<br/>
								</div>
							</div>
						<?php endforeach; ?>
						</div>
		
				
				</div>
                <div class="tab-pane" id="setting">Setting</div>
                <div class="tab-pane" id="achievements">
					<div class="row">
					<?php foreach($uBadge as $badge):?>
						<div class="s12 m6">
							<ul class="collection">
								<li class="collection-item avatar lime accent-1 pink-text">
								  <?php echo $this->Html->image('cake.icon.png', ['class' => 'circle responsive-img']) ?>
								  <span class="title"><h5><?php echo $badge['Badge']['name']; ?>  <i class="mdi-toggle-check-box green-text pull-right"></i></h5></span>
								  <p><?php echo $badge['Badge']['detail']; ?><br/>
								  </p>
								</li>
							</ul>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
				</div>
            </div>
        </div>
    </div>
</div>
