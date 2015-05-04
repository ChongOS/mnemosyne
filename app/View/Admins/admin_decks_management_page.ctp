<div class = 'row'></div>
<div class = 'row'></div>
<div class = 'row'></div>
<div class = 'row'>
		<a href = 'adminCreateDecksPage'>
		<div class="col s12 m3 offset-m2">
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
              <p> Create new decks.</p>
            </div>
          </div>
        </div>
		</a>
		
		<a href = 'adminAmendDecksPage'>
		<div class="col s12 m3 ">
          <div class="card pink lighten-2">
            <div class="card-content white-text">
              <span class="card-title"> Edit Decks  </span>
              <p> Edit deck, make it right !</p>
            </div>
          </div>
        </div>
		</a>
		
		<a href = 'adminDeleteDecksPage'>
		<div class="col s12 m3 ">
          <div class="card pink lighten-2">
            <div class="card-content white-text">
              <span class="card-title"> Delete Decks </span>
              <p> Delete your useless decks !</p>
            </div>
          </div>
        </div>
		</a>
		
		
		
</div>


<div class = 'row'>
			<a href = 'adminImportCVSDecksPage'>
		<div class="col s12 m3 offset-m2">
          <div class="card pink lighten-2">
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
              <p> Just type in excel import .csv and upload for create decks  !</p>
            </div>
          </div>
        </div>
		</a>

</div>