<div class="section white">
    <div class="container">
        <h5 class="grey-text">Statistic</h5>
        
        <div class="row">
            <div class="input-field col s12">
                <h4><small>Title : </small><?php echo $deck['Deck']['name'];?></h4>
                <h6>Description : <?php echo $deck['Deck']['description'];?></h6>
            </div>
        </div>
        
        
        <div class="row">
            <h5 class="center main-theme-text">Score</h5>
            
            <table class="responsive-table hoverable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Score</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $number = 1;
                    foreach($scores as $score):     
                ?>
                    <tr>
                        <td>
                            <?php 
                                echo $number;
                                $number++;
                            ?>
                        </td>
                        <td>
                            <?php echo $this->Html->link( $score['User']['username'],
                                [
                                    'controller' => 'profile',
                                    'action' => 'view',
                                     $score['User']['id']
                                ] );  
                            ?>
                        </td>
                        <td>
                           <?php echo $score['Score']['score']; ?>
                        </td>
                        <td>
                            <?php echo $score['Score']['modified']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <br/><br/>
         <div class="row">
            <h5 class="center main-theme-text">User Favorites</h5>
            
            <table class="responsive-table hoverable centered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $number = 1;
                    foreach($favoriteDeck as $user):     
                ?>
                    <tr>
                        <td>
                            <?php 
                                echo $number;
                                $number++;
                            ?>
                        </td>
                        <td>
                            <?php echo $this->Html->link( $score['User']['username'],
                                [
                                    'controller' => 'profile',
                                    'action' => 'view',
                                     $user['User']['id']
                                ] );  
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>