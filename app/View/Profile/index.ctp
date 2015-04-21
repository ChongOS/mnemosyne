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
                Firstname Lastname
            </h5>
            <p class="black-text col-s12">
                Flashcard Decks Created: 0 <br/>
                Favorite Flashcard Decks: 0<br/>
                Joined: <br/>
                Last Visit:
            </p>
        </div>
    </div>
</div>

<div class="row hide-on-med-and-up">

    <ul class="collapsible" data-collapsible="accordion">
        <li>
            <div class="collapsible-header"><i class="mdi-action-credit-card"></i>Flashcards</div>
            <div class="collapsible-body">
                <p>Flashcards</p>
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
                <div class="tab-pane active" id="flashcards">Flashcards</div>
                <div class="tab-pane" id="setting">Setting</div>
                <div class="tab-pane" id="achievements">Achievements</div>
            </div>
        </div>
    </div>
</div>
