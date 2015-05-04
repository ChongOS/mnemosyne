<div class = 'row'></div>
<div class = 'row'></div>
<div class = 'row'></div>
<div class = 'row'>
		<a href = 'adminCreateDecksPage'>
		<div class="col s12 m4">
          <div class="card pink lighten-2">
            <div class="card-content white-text">
              <span class="card-title"> 
                  <?php echo $this->Html->link(
                        '<h5>Create Flashcard Deck</h5>',
                        [
                            'controller' => 'admins',
                            'action' => 'add'
                        ], [
                            'class' => 'white-text',
                            'escape' => false
                        ]);
                    ?>
                </span>
              <p> Prepare deck before create new card.</p>
            </div>
          </div>
        </div>
		</a>
		
		<a href = 'adminAmendDecksPage'>
		 <div class="col s12 m4">
          <div class="card pink lighten-2">
            <div class="card-content white-text">
              <span class="card-title"> Edit Decks </span>
              <p> Change deck that you don't want. </p>
            </div>
          </div>
        </div>
		</a>
		
		<a href = 'adminDeleteDecksPage'>
		 <div class="col s12 m4">
 
          <div class="card pink lighten-2">
            <div class="card-content white-text">
              <span class="card-title"> Delete Decks </span>
              <p> Deliminate unused deck.</p>
            </div>
          </div>
        </div>
		</a>
</div>

<div class = 'row'>
    <a href = '#'>
    <div class="col s12 m4">
      <div class="card pink lighten-2">
        <div class="card-content white-text">
          <span class="card-title"> Delete High Score From Decks </span>
          <p> Prepare deck before create new card.</p>
        </div>
      </div>
    </div>
    </a>

    <a href = '#'>
     <div class="col s12 m4">
      <div class="card  pink lighten-2">
        <div class="card-content white-text">
          <span class="card-title">
            <?php echo $this->Html->link(
                '<h5>Import CSV file</h5>',
                [
                    'controller' => 'admins',
                    'action' => 'importCSV'
                ], [
                    'class' => 'white-text',
                    'escape' => false
                ]);
            ?>  
          </span>
          <p> Change deck that you don't want. </p>
        </div>
      </div>
    </div>
    </a>
</div>

<div class = 'row'></div>
<div class = 'row'></div>
<div class = 'row'></div>