<div class="container">
    <div class="row">
        <div class="col s12 m3 l2">
			<br/>
            <div class="col s4 offset-s4 m12">
				<?php $img = $userObj['User']['img'];
					if($img==null){$img = 'user.jpg';} ?>
                <img class="circle responsive-img" src="/mnemosyne/app/webroot/profiles/<?php echo $img; ?>">
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
					  $countFavorite = count($favorite);
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
						foreach ($deckShow as $deck): ?>
						
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
									<span class="right main-theme-text">
										<p>
		<!--                                    checked="checked"-->
										  <input type="checkbox" onclick="setFavorite($(this).attr('id'))" id='deck<?php echo $deck['Deck']['id']; ?>' <?php echo in_array($deck['Deck']['id'], $favorite) ? 'checked="checked"':''; ?> />
										  <label for='deck<?php echo $deck['Deck']['id']; ?>'>Favorite</label>
										</p>
										</span>
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
						<?php endforeach; ?>
						</div>
		
				
				</div>
				
                <div class="tab-pane" id="setting">
					<?php
					echo $this->Html->link(
						 'edit profile',
						 [
							 'controller' => 'profile',
							 'action' => 'edit_profile',
							 $userObj['User']['id']
						 ], [
							 'escape' => FALSE
						 ]
					 );
					 
					echo '<br/>'; 
					echo $this->Html->link(
						 'change password',
						 [
							 'controller' => 'profile',
							 'action' => 'change_password',
							 $userObj['User']['id']
						 ], [
							 'escape' => FALSE
						 ]
					 );
					?>
				</div>
                
				<div class="tab-pane" id="achievements">
					<div class="row">
					<?php foreach($uBadge as $badge):?>
						<div class="s12 m6">
						<?php $img = $badge['Badge']['thumbnail']; ?>
							<ul class="collection">
								<li class="collection-item avatar lime accent-1 pink-text">								  
								  <img class="circle responsive-img" src="/mnemosyne/app/webroot/imageForBadge/<?php echo $img; ?>" width="50" height="50">
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
