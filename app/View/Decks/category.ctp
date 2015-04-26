<div class="section">
    <div class="container">
        <div class="row">
        <div class="col s12 m4 l3">
            <h5 class="hide-on-small-only">Categories</h5>
            <div class="collection hide-on-small-only">
                <?php 
                    foreach($categories as $id => $name) {
                        echo $this->Html->link(
                            $name,
                                [
                                    'controller' => 'decks',
                                    'action' => 'category',
                                    $id
                                ], [
                                    'class' => 'collection-item '.($id==$category_id?'active':'')   
                                ]
                        ); 
                    }  
                ?>
            </div>
            <ul class="collapsible hide-on-med-and-up" data-collapsible="accordion">
                <li>
                    <div class="collapsible-header"><i class="mdi-image-dehaze"></i>Categories</div>
                    <div class="collapsible-body">
                        <div class="collection">
                            <?php 
                                foreach($categories as $id => $name) {
                                    echo $this->Html->link(
                                        $name,
                                            [
                                                'controller' => 'decks',
                                                'action' => 'category',
                                                $id
                                            ], [
                                                'class' => 'collection-item '.($id==$category_id?'active':'')   
                                            ]
                                    ); 
                                }  
                            ?>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col s12 m8 l9">
            <?php
                if(!count($data)) {
                    echo '<div class="center grey-text">
                            <br/><br/><br/><br/><br/><br/><br/>No Flashcard Deck<br/><br/><br/><br/><br/><br/><br/>
                         </div>';
                }
            ?>
            <?php foreach($data as $item): ?>
                <div class="col s12">
                    <div class="card-panel">
                        <div class="card-title">
                            <h5>
                            <?php echo $this->Html->link(
                                $item['Deck']['name'],
                                    [
                                        'controller' => 'Deck',
                                        'action' => 'reviewMode',
                                        $item['Deck']['id']
                                    ]
                                ); ?>
                            </h5>
                        </div>
                        <div class="card-content">
                            <span class="right main-theme-text">
                                <b><?php echo $item['Card']; ?></b> flashcard<?php echo $item['Card'] > 1 ? 's': ''; ?>
                            </span>
                            <h6><b><?php echo $item['Deck']['description']; ?></b></h6>
                            <h6>Tag: 
                                <?php 
                                    $tags = '';
                                    foreach($item['Tag'] as $tag) {
                                        $tags .= $this->Html->link(
                                            $tag['name'],
                                                [
                                                    'action' => 'tag',
                                                    $tag['id']
                                                ]
                                            ).', '; 
                                    }
                                    echo substr($tags, 0, -2);
                                ?>
                            </h6>
                            <h6>
                                Create by: <?php echo $this->Html->link(
                                $item['User']['username'],
                                    [
                                        'action' => 'profile',
                                        $item['User']['id']
                                    ]
                                ); ?> 
                            </h6>
                            <h6>
                                Created: <?php echo $item['Deck']['created']; ?> 
                            </h6>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function(){
        $('.collapsible').collapsible({
            accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
        });
    });
    
</script>