
<?php

    echo $this->Html->css('jquery.tagsinput.css');
    echo $this->Html->script('jquery.tagsinput.js');
    echo $this->fetch('css');
    echo $this->fetch('script');

?>


<?php echo $this->Form->create('Deck') ?>
    <div class="section white">
        <div class="container">
            <h5>Edit</h5>

            <div class="row">

                <div class="input-field col s6">
                    <?php
                        echo $this->Form->input('name', [
                            'label' => false,
                            'div' => false,
                            'class' => 'validate',
                            'value' => $deck['Deck']['name']
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
                            'class' => 'materialize-textarea',
                            'value' => $deck['Deck']['description']
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
                            'options' => $categories,
                            'value' => $deck['Deck']['category_id']
                        ]);
                        echo '</div>';
                    ?>
                   
                </div>
                <br/>
                <?php
                    echo $this->Form->input('cardOrder', [
                        'type' => 'hidden',
                        'id' => 'cards-order'
                    ]);
                
                    echo $this->Form->input('cardDelete', [
                        'type' => 'hidden',
                        'id' => 'cards-delete'
                    ]);

                     echo $this->Form->input('status', [
                        'type' => 'hidden',
                        'id' => 'deck-status',
                         'value' => 0
                    ]);
                ?>
                <div class="input-field col s12">
                    <label>Tag</label><br/><br/>
                    <?php
                        echo $this->Form->input('tags', [
                            'id' => 'tags',
                            'label' => false,
                            'div' => false, 
                            'value' => $tags
                        ]);
                    ?>
                    
                </div>
            </div>

        </div>
    </div>
    <div class="section grey lighten-3">
        <div class="container">
            <div id="sortable">

            </div>
        </div>
        <div class="section white">
            <div class="container center">
                <div class="row">
                    <div class="col s6 right-align">
                        <button class="btn waves-effect waves-light light-green" id="btn-submit" type="submit" name="action">Edit
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
                                    'class' => 'btn grey',
                                    'escape' => false
                                ]
                            );
                        ?>
                    </div>
                </div>
                <div class="row">
                    <a class="waves-effect waves-light light-green btn-large" onclick="document.getElementById('deck-status').value = 1; $('#btn-submit').click();">Edit and Publish <i class="mdi-action-launch right"></i></a>
                </div>
            </div>
        </div>
    </div>
<?php echo $this->Form->end(); ?>

<script type="text/javascript">
    
    var cardNumber = 0;
    var delID = [];
    
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
                sortCard();
            }
        });
        $("#sortable").disableSelection();
        $('.modal-trigger').leanModal({
                dismissible: true, // Modal can be dismissed by clicking outside of the modal
                opacity: .5, // Opacity of modal background
                in_duration: 300, // Transition in duration
                out_duration: 200, // Transition out duration
                ready: function() { }, // Callback for Modal open
                complete: function() { } // Callback for Modal close
            }
        );
        
        var cards = <?php echo $cards; ?>;
        cardNumber = cards.length;
        var i;
        for(i=0; i<cards.length; i++) {
            var front = eval('('+cards[i].Card.front.replace('"', '\'') +')');
            var back = eval('('+cards[i].Card.back+')');
   
            var cardElement = document.createElement("div");
            cardElement.className = "row";
            cardElement.id = 'card'+cards[i].Card.sort_number;
            cardElement.innerHTML = '<div class="col s1 m1">'+
                    '<h5 id="title-card'+cards[i].Card.sort_number+'">'+cards[i].Card.sort_number+'</h5>'+
                    '<input type="hidden" value="'+cards[i].Card.id+'">'+
                '</div>'+
                '<div class="col m10 s10">'+
                    '<div class="col m6 s12">'+
                        '<div class="card">'+
                            '<div class="card-content">'+
                                '<span class="card-title black-text">Front</span>'+
                                '<div class="card-text-content">'+
                ( typeof front.text != 'undefined' ? '"'+front.text+'"' : '<img class="responsive-img" src="/mnemosyne/app/webroot/files/'+front.image+'">')+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col m6 s12">'+
                        '<div class="card">'+
                            '<div class="card-content">'+
                                '<span class="card-title black-text">Back</span>'+
                                '<div class="card-text-content">'+
                                    (typeof back.text != 'undefined' ? back.text : '<img class="responsive-img" src="/mnemosyne/app/webroot/files/'+back.image+'">')+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="col m1 s1">'+
                    '<i class="move-card small mdi-action-swap-vert-circle"></i>'+
                    '<i class="small mdi-action-delete" onclick="deleteCard($(this).parent().parent().attr(\'id\'))"></i>'+
                '</div>';
            
            document.getElementById('sortable').appendChild(cardElement);
        }
        sortCard();
    });
    
    function sortCard() {
        var order = $('#sortable').sortable('toArray');
        var i; 
        var cards = [];
        for(i=0; i<order.length; i++) {
            cards.push({'id': $('#'+order[i]+' input:hidden').val(), 'sort_number': i+1});
        }
        document.getElementById('cards-order').value = JSON.stringify(cards);   
    }
    
    
    function deleteCard(id) {
        if(confirm('Are you sure?')) {
            delID.push({'Card.id': $('#'+id+' input:hidden').val()});
            $('#'+id).remove();
            document.getElementById('cards-delete').value = JSON.stringify(delID);

            var card_id = parseInt(id.substr(id.length-1));
            var i;
            for(i=card_id+1; i<=cardNumber; i++) {
                var title = document.getElementById('title-card'+i);
                title.innerHTML = i-1;
                title.id = 'title-card'+(i-1);
                document.getElementById('card'+i).id = 'card'+(i-1);
            }
            cardNumber--;
            sortCard();
        }
    }

</script>