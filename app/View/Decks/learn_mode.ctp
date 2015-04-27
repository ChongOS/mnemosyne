<?php

echo $this->Html->css("learn_mode.css");
echo $this->Html->script("learn_mode.js");

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
        Learning - <?php echo $deck_name ?>
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

    <div class="top-bottom-padding-adjustment" hidden="hidden">

        <?php foreach ($cards as $card):

            if ($counter != 0): ?>

                <div class="card right-card">
                    <div class="col z-depth-1 card-wrapper">
                        <div class="front">
                            <p class="card-head">Question</p>
                            <?php

                            $front = prepareString($card['Card']['front']);


                            if (whichType($front['type']) === 'image') {
                                echo '<img class="center" src="' . $front['data'] . '">';
                            }

                            else if (whichType($front['type']) === 'text') {
                                echo $front['data'];
                            }


                            ?>
                            <button class="waves-effect waves-teal btn-flat">
                                <i class="mdi-action-flip-to-back left"></i>Answer
                            </button>
                        </div>
                        <div class="back">
                            <p class="card-head">Answer</p>
                            <?php

                            $back = prepareString($card['Card']['back']);


                            if (whichType($back['type']) === 'image') {
                                echo '<img class="center" src="' . $back['data'] . '">';
                            }

                            else if (whichType($back['type']) === 'text') {
                                echo $back['data'];
                            }


                            ?>
                            <button class="waves-effect waves-teal btn-flat">
                                <i class="mdi-action-flip-to-front left"></i>Question
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


                            if (whichType($front['type']) === 'image') {
                                echo '<img class="center" src="' . $front['data'] . '">';
                            }

                            else if (whichType($front['type']) === 'text') {
                                echo $front['data'];
                            }


                            ?>

                            <button class="waves-effect waves-teal btn-flat">
                                <i class="mdi-action-flip-to-back left"></i>Answer
                            </button>
                        </div>
                        <div class="back">
                            <p class="card-head">Answer</p>
                            <?php

                            $back = prepareString($card['Card']['back']);


                            if (whichType($back['type']) === 'image') {
                                echo '<img class="center" src="' . $back['data'] . '">';
                            }

                            else if (whichType($back['type']) === 'text') {
                                echo $back['data'];
                            }


                            ?>

                            <button class="waves-effect waves-teal btn-flat">
                                <i class="mdi-action-flip-to-front left"></i>Question
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
            <button class="waves-effect waves-light btn disabled" id="btn-back" disabled><i class="mdi-navigation-arrow-back left"></i> Back</button>
            <button class="waves-effect waves-light btn" id="btn-next">Next <i class="mdi-navigation-arrow-forward right"></i></button>
        </div>
    </div>
</div>