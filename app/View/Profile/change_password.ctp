<?php echo $this->Form->create('User',[ 
		'url' => [
				'controller' => 'profile',
				'action' => 'change_password',
				$u_id
			]
		]);
?>
<div class="container">
    <div class="m10 s12"><br/><br/>
        <div class="container">
			
            <div class="input-field col s6">
                    <?php
                        echo $this->Form->input('username', [
                            'label' => 'Username',
							'readonly',
                            'div' => false,
                            'class' => 'validate',
                            'value' => $userObj['User']['username']
                        ]);
                    ?>
			
			</div>
			<div class="input-field col s6">
                    <?php
                        echo $this->Form->input('newpassword', [
                            'label' => 'new password',
                            'div' => false,
                            'class' => 'validate',
							'type' => 'password',
                        ]);
                    ?>
            </div>
			<div class="input-field col s6">
                    <?php
                        echo $this->Form->input('confirmpassword', [
                            'label' => 'confirm password *',
                            'div' => false,
                            'class' => 'validate',
							'type' => 'password',
                        ]);
                    ?>
            </div>		
			
			<div class="col s6 center">
				<?php 
					echo $this->Form->button(
						'Edit', 
						array('div' => false,'class' => 'waves-effect waves-light btn', 'type' => 'submit')
					);
				?>
            </div>
    <?php echo $this->Form->end(); ?>
    <br/><br/>
	</div>
	</div>
</div>