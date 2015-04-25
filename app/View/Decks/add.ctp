<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script>

    var currentCardID;
    var currentType;
    var cards = [];
    var value;

    function setCardNum(id, type) {
        currentCardID = id;
        currentType = type;
        if(type == 'text') {
            tinymce.activeEditor.setContent(document.getElementById(currentCardID).innerHTML);
            tinymce.activeEditor.focus();
        } else if(type == 'image'){
            
        }
        $('#modal-'+type).openModal();
    }

    tinymce.init({
        selector:'#text-editor',
        setup : function(ed) {
            ed.on('change', function(e) {
                value = tinymce.get('text-editor').getContent();
                document.getElementById(currentCardID).innerHTML = value;
            });
        }
    });

</script>

<?php

    echo $this->Html->css('jquery.tagsinput.css');
    echo $this->Html->script('jquery.tagsinput.js');
    echo $this->fetch('css');
    echo $this->fetch('script');

?>
<!--<form>-->
<?php echo $this->Form->create('Deck') ?>
    <div class="section white">
        <div class="container">
            <h5>Create a New Flashcard Deck</h5>

            <div class="row">

                <div class="input-field col s6">
                    <?php
                        echo $this->Form->input('name', [
                            'label' => false,
                            'div' => false,
                            'class' => 'validate'
                        ]);
                    ?>
                    <label>Title</label>
                </div>

                <div class="input-field col s12">
                    <?php
                        echo $this->Form->input('description', [
                            'type' => 'textarea',
                            'label' => false,
                            'div' => false,
                            'class' => 'materialize-textarea'
                        ]);
                    ?>
                    <label>Description</label>
                </div>

                <div class="input-field col s12">
<!--                    <input id="set_category" type="text" class="validate">-->
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
                <br/>
                <?php
                    echo $this->Form->input('cards', [
                        'type' => 'hidden',
                        'id' => 'cards-input'
                    ]);
                ?>
                <div class="input-field col s12">
                    <label>Tag</label><br/><br/>
                    <?php
                        echo $this->Form->input('tags', [
                            'id' => 'tags',
                            'label' => false,
                            'div' => false
                        ]);
                    ?>
                    
                </div>
            </div>

        </div>
    </div>
    <div class="section grey lighten-3">
        <div class="container">
            <div id="sortable">

                <div id="add-new-card-button" class="row center">
                    <a class="waves-effect waves-light btn-large btn-flat" onclick="addNewCard()"><i class="mdi-content-add-circle left"></i>Add a new card</a>
                </div>

            </div>
        </div>
        <div class="section white">
            <div class="container center">
                <div class="row">
                    <div class="col s6 right-align">
                        <button class="btn waves-effect waves-light btn-large light-green" type="submit" name="action">Create Deck
                            <i class="mdi-action-done right"></i>
                        </button>
                    </div>
                    <div class="col s6 left-align">
                        <?php
                            echo $this->Html->link('Cancel <i class="mdi-navigation-close right"></i>',
                                [
                                    'controller' => 'Profile',
                                    'action' => 'index'
                                ],
                                [
                                    'class' => 'btn-large grey',
                                    'escape' => false
                                ]
                            );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php echo $this->Form->end(); ?>
<!--</form>-->


<div id="modal-text" class="modal bottom-sheet">
    <div class="modal-content">
        <h4>Text Editor</h4>
        <div class="input-field col s12">
            <textarea id="text-editor" class="text-editor"></textarea>
        </div>
    </div>
</div>

<div id="modal-image" class="modal bottom-sheet">
    <div class="modal-content">
        <h4>Upload Image</h4>
        <?php 
            echo $this->UploadTemplate->renderForm(array('action' => '/mnemosyne/images/upload')); //Set action for form
            echo $this->UploadTemplate->renderListFiles(array('action_delete' => '/mnemosyne/images/deleteFile')); //Set action for remove files

            /* Load libs js e css jQuery-File-Upload and dependences */
            echo $this->UploadScript->loadLibs();
            echo $this->Html->scriptBlock("
                $(function () {
                    $('#fileupload').fileupload({
                            xhrFields   : {withCredentials: true},
                            url         : '/mnemosyne/images/upload',
                            multipart: false,
                            dataType: 'json'
                           
                    })
                });    
            ");
        ?>
    </div>
</div>


<script type="text/javascript">

    var currentCardNumber = 0;
    
    function closeModal() {
        var id = parseInt(currentCardID.substr(currentCardID.length-1));
        var card = cards[id-1];
        if(currentCardID.substr(0, currentCardID.length-1) == 'front')
            card.front = {'type':currentType, 'value': value};
        else
            card.back = {'type':currentType, 'value': value};
        
//        console.log(JSON.stringify(cards));
        
        document.getElementById('cards-input').value = JSON.stringify(cards);
    }
    
    $(document).ready(function() {
        $('#tags').tagsInput({
            'height':'100px',
            'width':'100%',
            'interactive':true,
            'defaultText':'add a tag',
            'delimiter': [',',';'],
            'removeWithBackspace' : true,
            'minChars' : 2,
            'placeholderColor' : '#666666'
        });
        
        $("#sortable").sortable({
            handle: ".move-card",
            placeholder: "ui-state-highlight"
        });
        $("#sortable").disableSelection();
        $('.modal-trigger').leanModal({
                dismissible: true, // Modal can be dismissed by clicking outside of the modal
                opacity: .5, // Opacity of modal background
                in_duration: 300, // Transition in duration
                out_duration: 200, // Transition out duration
                ready: function() { }, // Callback for Modal open
                complete: function() { 
                    
                } // Callback for Modal close
            }
        );
        addNewCard();
    })
    
    function addNewCard() {
        currentCardNumber++;
        var parentElement = document.getElementById('sortable');
        var lastChild = document.getElementById('add-new-card-button');
        var newElement = document.createElement("div");
        newElement.className = "row";
        newElement.id = 'card'+currentCardNumber;
        newElement.innerHTML = '<div class="col s1 m1">'+
                    '<h5 id="title-card'+currentCardNumber+'">'+currentCardNumber+'</h5>'+
                '</div>'+
                '<div class="col m10 s10">'+
                    '<div class="col m6 s12">'+
                        '<div class="card">'+
                            '<div class="card-content">'+
                                '<span class="card-title black-text">Front</span>'+
                                '<div id="front'+currentCardNumber+'" class="card-text-content">'+

                                '</div>'+

                            '</div>'+
                            '<div class="row center">'+
                                '<a class="waves-effect waves-teal btn-flat modal-trigger" data-target="modal-text" onclick="setCardNum(\'front'+currentCardNumber+'\',\'text\')">'+
                                    '<i class="mdi-hardware-keyboard left"></i>Text'+
                                '</a>'+
                                '<a class="waves-effect waves-teal btn-flat modal-trigger" data-target="modal-upload" onclick="setCardNum(\'front'+currentCardNumber+'\',\'image\')">'+
                                    '<i class="small mdi-image-image left"></i>Image'+
                                '</a>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col m6 s12">'+
                        '<div class="card">'+
                            '<div class="card-content">'+
                                '<span class="card-title black-text">Back</span>'+
                                '<div id="back'+currentCardNumber+'" class="card-text-content">'+

                                '</div>'+
                            '</div>'+
                            '<div class="row center">'+
                                '<a class="waves-effect waves-teal btn-flat modal-trigger" data-target="modal-text" onclick="setCardNum(\'back'+currentCardNumber+'\',\'text\')">'+
                                    '<i class="mdi-hardware-keyboard left"></i>Text'+
                                '</a>'+
                                '<a class="waves-effect waves-teal btn-flat modal-trigger" data-target="modal-upload" onclick="setCardNum(\'back'+currentCardNumber+'\',\'image\')">'+
                                    '<i class="small mdi-image-image left"></i>Image'+
                                '</a>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>';
//                '<div class="col m1 s1">'+
//                    '<i class="move-card small mdi-action-swap-vert-circle"></i>'+
//                    '<i class="small mdi-action-delete" onclick="deleteCard('+currentCardNumber+')"></i>'+
//                '</div>';
        parentElement.insertBefore(newElement, lastChild);

        var card = {"front":{'type':'text', 'value': ''}, "back":{'type':'text', 'value': ''}};

        cards.push(card);
    }
    
    function selectFile(filename, fileurl) {
        document.getElementById(currentCardID).innerHTML = '<i class="mdi-content-clear right" onclick="clearImage(\''+currentCardID+'\')"></i><img class=\"responsive-img\" src=\"'+fileurl+'\">';
        value = filename;
    }
    
    function clearImage(cardID) {
        var id = parseInt(cardID.substr(cardID.length-1));
        var card = cards[id-1];
        if(cardID.substr(0, cardID.length-1) == 'front')
            card.front = {'type':'text', 'value': ''};
        else
            card.back = {'type':'text', 'value': ''};
        document.getElementById(cardID).innerHTML = '';
    }
    

</script>