<?php

echo $this->Html->css("review_mode.css");
echo $this->Html->script("review_mode.js");
echo $this->Html->script("jquery-ui.min.js");

$counter = 0;

function prepareString($string) {
    $string = str_replace('{', '', $string);
    $string = str_replace('}', '', $string);
    $string = str_replace('\'', '', $string);
    $string = explode(':', $string, 2);
    $result = array('type' => $string[0], 'data' => $string[1]);
    return $result;
}

function whichType($string) {

    if (substr($string, 0, 4) === 'text') {
        return 'text';
    }
    else if (substr($string, 0, 5) === 'image') {
        return 'image';
    }

}

?>

<div class="row">
    <h5 id="header">
        Reviewing - <?php echo $deck_name ?>
    </h5>
</div>

<div class="row" id="card-container">

    <div class="preloader-wrapper big active">
        <div class="spinner-layer spinner-red-only">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
    </div>
    
    <div id="notification" class="card middle-card col z-depth-1" hidden="hidden">
		<h5></h5>
	</div>

    <div class="top-bottom-padding-adjustment" hidden="hidden">

        <?php foreach ($cards as $card):

            if ($counter != 0): ?>

                <div class="card right-card">
                    <div class="col z-depth-1 card-wrapper">
                        <div class="front">
                            <p class="card-head">Question</p>
                            
                            <?php

                            $front = prepareString($card['Card']['front']);


                            if (whichType($front['type']) === 'image'): ?>
                            
                                <img class="center" src="/mnemosyne/app/webroot/files/<?php echo $front['data']; ?>">

                            <?php elseif (whichType($front['type']) === 'text'): ?>
                                
                                <?php echo $front['data']; ?>


                            <?php endif; ?>
                            
                            <button class="waves-effect waves-teal btn-flat answer-button">
                                <i class="mdi-action-flip-to-back left"></i>Answer
                            </button>
                        </div>
                        <div class="back">
                            <p class="card-head">Answer</p>
                            
							<div class="input-field">
	                            <?php echo $this->Form->input($counter, array('type' => 'text', 'div' => false, 'placeholder' => 'Type the answer here', 'class' => 'validate')); ?>
        					</div>
							
                            <button class="waves-effect waves-teal btn-flat submit-button">
                                <i class="mdi-content-send left"></i>Submit
                            </button>
                        </div>
                    </div>
                </div>

            <?php else: ?>

                <div class="card middle-card">
                    <div class="col z-depth-1 card-wrapper">
                        <div class="front">
                            <p class="card-head">Question</p>
                            
                            <?php

                            $front = prepareString($card['Card']['front']);


                            if (whichType($front['type']) === 'image'): ?>
                            
                                <img class="center" src="/mnemosyne/app/webroot/files/<?php echo $front['data']; ?>">

                            <?php elseif (whichType($front['type']) === 'text'): ?>
                                
                                <?php echo $front['data']; ?>


                            <?php endif; ?>

                            <button class="waves-effect waves-teal btn-flat answer-button">
                                <i class="mdi-action-flip-to-back left"></i>Answer
                            </button>
                        </div>
                        <div class="back">
                            <p class="card-head">Answer</p>
                            
                            <div class="input-field">
	                            <?php echo $this->Form->input($counter, array('type' => 'text', 'div' => false, 'placeholder' => 'Type the answer here', 'class' => 'validate')); ?>
        					</div>

                            <button class="waves-effect waves-teal btn-flat submit-button">
                                <i class="mdi-content-send left"></i>Submit
                            </button>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

            <?php $counter++ ?>

        <?php endforeach; ?>

    </div>
</div>

<div class="row">
    <div class="col s4 offset-s4">
        <div class="center-align top-bottom-padding-adjustment">
            <p id="counter">1 of 10</p>
        </div>
    </div>
</div>