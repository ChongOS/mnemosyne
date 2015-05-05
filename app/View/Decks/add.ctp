<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script>
    var currentCardID;
    var cardNumber = 0;
    
    tinymce.init({
        selector:'#text-editor',
        setup : function(ed) {
            ed.on('change', function(e) {
                value = tinymce.get('text-editor').getContent();
                document.getElementById(currentCardID).innerHTML = value;
                document.getElementById('type-'+currentCardID).value = 'text';
            });
        }
    });

</script>


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
                
                <div class="input-field col s12">
                    <label>Tags</label><br/><br/>
                    <div class="row">
                            <?php
                                echo $this->Form->input('tags', [
                                    'multiple' => 'checkbox', 
                                    'class' => 'col s6 m4',
                                    'options' => $tags
                                ]);
                            ?>
                    </div>
                   
                </div>
            </div>
            <?php
                echo $this->Form->input('cards', [
                    'type' => 'hidden',
                    'id' => 'input-cards'
                ]);
            ?>

        </div>
    </div>
    <div class="section grey lighten-3">
        <div class="container">
            <div id="sortable">
                <!-- Add card here -->
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
            echo $this->UploadTemplate->renderForm(array('action' => 'upload')); //Set action for form
            echo $this->UploadTemplate->renderListFiles(array('action_delete' => 'deleteFile')); //Set action for remove files

            /* Load libs js e css jQuery-File-Upload and dependences */
            echo $this->UploadScript->loadLibs();
            echo $this->Html->scriptBlock("
                $(function () {
                    $('#fileupload').fileupload({
                            xhrFields   : {withCredentials: true},
                            url         : 'upload',
                            dataType: 'json'
                           
                    })
                });    
            ");
        ?>
    </div>
</div>


<script type="text/javascript">
    
    $(document).ready(function() {
        $("#sortable").sortable({
            handle: ".move-card",
            placeholder: "ui-state-highlight",
            start: function(event, ui) {
                var start_pos = ui.item.index() + 1;
                ui.item.data('start_pos',start_pos);
                
                var title = document.getElementById('title-card'+start_pos);
                title.innerHTML = '-';
                title.id = 'title-card0';
                document.getElementById('card'+start_pos).id = 'card0';
            },
            change: function(event, ui) {
                var start_pos = ui.item.data('start_pos');
                var index = ui.placeholder.index()+1;
                
                if (start_pos < index) {
                    var title = document.getElementById('title-card'+(index-1));
                    title.innerHTML = index-2;
                    title.id = 'title-card'+(index-2);
                    document.getElementById('card'+(index-1)).id = 'card'+(index-2);
                    
                } else if (start_pos > index) {
                    var title = document.getElementById('title-card'+index);
                    title.innerHTML = index+1;
                    title.id = 'title-card'+(index+1);
                    document.getElementById('card'+index).id = 'card'+(index+1);
                }
            },
            stop: function (event, ui) {
                var start_pos = ui.item.data('start_pos');
                var end_pos = ui.item.index() + 1;
                
                var title = document.getElementById('title-card0');
                title.innerHTML = end_pos;
                title.id = 'title-card'+end_pos;
                document.getElementById('card0').id = 'card'+end_pos;
            }
        });
        
        $("#sortable").disableSelection();  
        addNewCard();
        
        $('#DeckAddForm').submit(function(e) {
            var cardID = $('#sortable').sortable('toArray');
            var i, j; 
            var cards = [];
            var side = ['front', 'back'];
            
            for(i=0; i<cardID.length-1; i++) {
                var objCard = {};
                for(j=0; j<side.length; j++) {
                    var card = $('#'+cardID[i]).find('.'+side[j]+'-card').children().children('div:first');
                    var cardType = $(' .card-type', card).attr("value");
                    var cardContent = cardType == 'image' ? $(' .responsive-img', card).attr('name') : $(' .card-text-content', card).html();
                    
                    if(cardContent == '') {
                        Materialize.toast('Please fill in '+side[j]+' side of '+cardID[i]+'', 5000);
                        return false;   
                    }
                    objCard[side[j]] = '{\''+cardType+'\':\''+cardContent+'\'}';   
                }
                objCard.sort_number = i+1;
                cards.push(objCard);   
            }
            document.getElementById('input-cards').value = JSON.stringify(cards);
        });
    });
    
    function openModal(id, type) {
        currentCardID = id;
        if(type == 'text') {
            var typeValue = document.getElementById('type-'+currentCardID).value;
            var content = typeValue == 'image' ? '' : document.getElementById(currentCardID).innerHTML;
            tinymce.activeEditor.setContent(content);
            tinymce.activeEditor.focus();
        }
        $('#modal-'+type).openModal();
    }
    
    function addNewCard() {
        cardNumber++;
        var parentElement = document.getElementById('sortable');
        var lastChild = document.getElementById('add-new-card-button');
        var newElement = document.createElement("div");
        newElement.className = "row";
        newElement.id = 'card'+cardNumber;
        newElement.innerHTML = '<div class="col s1 m1">'+
                    '<h5 id="title-card'+cardNumber+'">'+cardNumber+'</h5>'+
                '</div>'+
                '<div class="col m10 s10">'+
                    '<div class="col m6 s12 front-card">'+
                        '<div class="card">'+
                            '<div class="card-content">'+
                                '<span class="card-title black-text">Front</span>'+
                                '<input type="hidden" id="type-fnt'+cardNumber+'" class="card-type" value="text"/>'+
                                '<div id="fnt'+cardNumber+'" class="card-text-content">'+

                                '</div>'+

                            '</div>'+
                            '<div class="row center">'+
                                '<a class="waves-effect waves-teal btn-flat modal-trigger" data-target="modal-text" onclick="openModal(\'fnt'+cardNumber+'\',\'text\')">'+
                                    '<i class="mdi-hardware-keyboard left"></i>Text'+
                                '</a>'+
                                '<a class="waves-effect waves-teal btn-flat modal-trigger" data-target="modal-upload" onclick="openModal(\'fnt'+cardNumber+'\',\'image\')">'+
                                    '<i class="small mdi-image-image left"></i>Image'+
                                '</a>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col m6 s12 back-card">'+
                        '<div class="card">'+
                            '<div class="card-content">'+
                                '<span class="card-title black-text">Back</span>'+
                                '<input type="hidden" id="type-bck'+cardNumber+'" class="card-type" value="text"/>'+
                                '<div id="bck'+cardNumber+'" class="card-text-content">'+

                                '</div>'+
                            '</div>'+
                            '<div class="row center">'+
                                '<a class="waves-effect waves-teal btn-flat modal-trigger" data-target="modal-text" onclick="openModal(\'bck'+cardNumber+'\',\'text\')">'+
                                    '<i class="mdi-hardware-keyboard left"></i>Text'+
                                '</a>'+
                                '<a class="waves-effect waves-teal btn-flat modal-trigger" data-target="modal-upload" onclick="openModal(\'bck'+cardNumber+'\',\'image\')">'+
                                    '<i class="small mdi-image-image left"></i>Image'+
                                '</a>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="col m1 s1">'+
                    '<i class="move-card small mdi-action-swap-vert-circle"></i>'+
                    '<i class="small mdi-action-delete" onclick="deleteCard($(this).parent().parent().attr(\'id\'))"></i>'+
                '</div>';
        parentElement.insertBefore(newElement, lastChild);
    }
    
    function deleteCard(id) {
        if(confirm('Do you want to delete '+id+' ?')) {
            $('#'+id).remove();
            var card_id = parseInt(id.substr(4));
            var i;
            for(i=card_id+1; i<=cardNumber; i++) {
                var title = document.getElementById('title-card'+i);
                title.innerHTML = i-1;
                title.id = 'title-card'+(i-1);
                document.getElementById('card'+i).id = 'card'+(i-1);
            }
            cardNumber--;
        }
    }
    
    function selectFile(filename) {
        document.getElementById('type-'+currentCardID).value = 'image';
        document.getElementById(currentCardID).innerHTML = '<i class="mdi-content-clear right" onclick="clearImage(\''+currentCardID+'\')"></i><img class=\"responsive-img\" name=\"'+filename+'\" src=\"/mnemosyne/files/'+filename+'\">';
    }
    
    function clearImage(cardID) {
        document.getElementById(cardID).innerHTML = '';
        document.getElementById('type-'+currentCardID).value = 'text';
    }

</script>