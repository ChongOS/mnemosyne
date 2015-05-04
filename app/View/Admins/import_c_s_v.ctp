<br/>
<div class="container">
<h5>Import CSV file</h5>
    <?php echo $this->Form->create('Admins', array('type' => 'file')); ?>
    <div class="input-field col s12">
        <label>Category</label><br/><br/>
        <?php
            echo '<div class="row">';
            echo $this->Form->input('category_id', [
                'type' => 'radio',
                'legend' => false,
                'before' => '<div class="col s6 m4">',
                'after' => '</div>',
                'separator' => '</div><div class="col s6 m4">',
                'options' => $categories
            ]);
            echo '</div>';
        ?>

    </div>
    <div class="input-field col s12 center">
        <label>Select File</label><br/><br/>
         <div class="file-field input-field">
          <input class="file-path validate" type="text"/>
          <div class="btn">
            <span>File</span>
            <?php
                echo $this->Form->file('csv');
            ?>
          </div>
        </div>
        <br/><br/><br/>
        <button class="btn waves-effect waves-light light-green" type="submit" name="action">Submit
        </button>
    </div>
    <?php echo $this->Form->end(); ?>
</div>