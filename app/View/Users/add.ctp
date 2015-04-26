<nav>
    <div class="nav-wrapper white">
        <div class="container">
            <a href="#" class="brand-logo main-theme-text">Mnemosyne</a>
        </div>
    </div>
</nav>
<nav>
    <div class="nav-wrapper">
        <div class="container">
        </div>
    </div>
</nav>

<div class="row center">
    <h3 class="grey-text text-darken-2">Sign Up</h3>
</div>


<div class="container">
    <div class="card">
        <div class="container">
            <br/><br/>
            <?php echo $this->Form->create('User');?>
            <div class="row">
                <div class="input-field col s12">
                <?php echo $this->Form->input('username'); ?>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                <?php echo $this->Form->input('firstname'); ?>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                <?php echo $this->Form->input('lastname'); ?>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                <?php echo $this->Form->input('email'); ?>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                <?php echo $this->Form->input('password'); ?>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                <?php echo $this->Form->input('password_confirm', array('label' => 'Confirm Password *', 'maxLength' => 255, 'title' => 'Confirm password', 'type'=>'password')); ?>
                </div>
            </div>
            <br/><br/>
        </div>
    </div>
    <br/><br/>
    <div class="row center">
        <?php echo $this->Form->submit('Sign Up', array('class' => 'btn light-green')); ?>
    </div>
    <?php echo $this->Form->end(); ?>
    <br/><br/>
</div>