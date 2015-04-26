<div class="section" >
    <div id="index-banner" class="parallax-container" >
        <div class="section no-pad-bot">
            <div class="row center">
               <h5><br/></h5>
            </div>
            <div class="row center">
                <h4 class="brown-text text-draken-1">Ready To Get Started?</h4>
            </div>
            <div class="row center">
                <?php
                    echo $this->Html->link(
                        'Create Flashcard',
                        [
                            'controller' => 'decks',
                            'action' => 'add'
                        ],
                        [
                            'class' => 'btn-large waves-effect waves-light light-green',
                            'escape' => FALSE
                        ]);
                ?>
            </div>
        </div>
        <div class="parallax">
            <?php echo $this->Html->image('flashcard.jpg'); ?>
        </div>
    </div>
</div>

<div class="section" >

    <div class="container">
        <div class="row">
            <h5 class="center-align grey-text text-darken-2">Browse By Category</h5>
        </div>

        <div class="collection">
            <?php 
                foreach($categories as $id => $name) {
                    echo $this->Html->link(
                        $name,
                            [
                                'controller' => 'decks',
                                'action' => 'category',
                                $id
                            ], [
                                'class' => 'collection-item '   
                            ]
                    ); 
                }  
            ?>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {
        $('.parallax').parallax();
    });

</script>