<?php echo $this->Form->create('User1',[ 
		'url' => [
				'controller' => 'profile',
				'action' => 'edit_profile',
				$u_id
			],
		'type' => 'file'
		]);
?>
<div class="container">
    <div class="m10 s12"><br/><br/>
        <div class="container">
			<?php $img = $userObj['User']['img'];
					if($img==null){$img = 'user.jpg';} ?>
			
			<div class="col s3 m4">
				 <img class="center circle responsive-img" src="/mnemosyne/app/webroot/profiles/<?php echo $img; ?>" width="150" height="150"><br/><br/>
				 <?php echo $this->Form->input('upload', array('type'=>'file','label' => 'upload image')); ?>
				 <br/>
			</div>
           <div class="input-field col s6">
                    <?php
                        echo $this->Form->input('firstname',[
                            'label' => 'First Name',
                            'class' => 'validate',
                            'value' => $userObj['User']['firstname']
                        ]);
                    ?>
			
			</div>
			<div class="input-field col s6">
                    <?php
                        echo $this->Form->input('lastname', [
                            'label' => 'Last Name',
                            'class' => 'validate',
                            'value' => $userObj['User']['lastname']
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