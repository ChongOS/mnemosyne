<body class="main-theme">
<div class="row">
    <div class="col m10 offset-m1">
        <div class="col l5 m12 s12">
            <div class="col s8 m6 l10 offset-s2 offset-l1 offset-m3">
                <br/>
                <div class="hide-on-med-and-down">
                    <br/><br/><br/><br/><br/><br/>
                </div>
                <?php echo $this->Html->image('logo.png', ['class' => 'responsive-img']) ?>
            </div>
        </div>
        <div class="col l7 m12 s12">
            <div class="hide-on-med-and-down">
                <br/><br/><br/>
            </div>

            <div class="card-panel">
                <div class="row">
                    <h4 class="center-align main-theme-text">Sign In</h4>
                </div>
                <?php echo $this->Form->create('User'); ?>
                    <div class="row">
                        <div class="input-field col s11">
                            <i class="mdi-action-account-circle prefix"></i>
                            <?php
                                echo $this->Form->input('username', [
                                    'label' => false,
                                    'div' => false,
                                    'class' => 'validate'
                                ]);
                            ?>
                            <label for="icon_prefix">Username</label>
                        </div>
                        <div class="input-field col s11">
                            <i class="mdi-communication-vpn-key prefix"></i>
                            <?php
                                echo $this->Form->input('password', [
                                    'label' => false,
                                    'div' => false,
                                    'class' => 'validate'
                                ]);
                            ?>
                            <label for="icon_prefix">Password</label>
                        </div>
                    </div>
                    <div class="row valign-wrapper">
                        <div class="col s6 right-align">
                            <p>
                                <input type="checkbox" id="test5"/>
                                <label for="test5">Remember Me</label>
                            </p>
                        </div>
                        <div class="col s6 left-align">
                            <?php
                                echo $this->Form->submit('Login', [
                                    'class' => 'btn light-green'
                                ]);
                            ?>
                        </div>
                    </div>
                <?php echo $this->Form->end(); ?>
                <div class="row center-align">
                    <a class="waves-effect waves-light btn blue darken-4">Connect With Facebook</a>
                </div>
                <div class="row">
                    <div class="center-align" >
<!--                        <a href="register.php"> <h6>Sign up</h6></a>-->
                        <?php
                            echo $this->Html->link( "Sign up",   array('action'=>'add') );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>