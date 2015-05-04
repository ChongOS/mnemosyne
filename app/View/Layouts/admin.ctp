
<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>Admin - Mnemosyne </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('materialize.css');
        echo $this->Html->css('style.css');

        echo $this->Html->script('jquery-2.1.3.min.js');
        echo $this->Html->script('jquery-ui.js');
        echo $this->Html->script('materialize.js');
        echo $this->Html->script('script.js');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
    <nav>
        <div class="nav-wrapper white">
            <div class="container ">
                <a href="#" class="brand-logo main-theme-text">Mnemosyne</a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li>
                        <?php echo $this->Html->link(
                            'Logout',
                            [
                                'controller' => 'users',
                                'action' => 'logout'
                            ], [
                                'class' => 'main-theme-text'
                            ]);
                        ?>
                    </li>
<!--
                    <li>
                        <a class="main-theme-text">Profile</a>
                        <?php echo $this->Html->link(
                            'Profile', [
                                'controller' => 'profile',
                                'action' => 'index'
                            ], [
                                'class' => 'main-theme-text dropdown-button',
                                'data-activates' => "dropdown-profile-menu"
                            ]);
                        ?>
                    </li>
-->
<!--
                    <ul id="dropdown-profile-menu" class="dropdown-content">
                        <li><a> one </a></li>
                        <li><a>two</a></li>
                        <li class="divider"></li>
                        <li>
                            <?php echo $this->Html->link(
                                'Logout',
                                [
                                    'controller' => 'users',
                                    'action' => 'logout'
                                ], [
                                    'class' => 'main-theme-text'
                                ]);
                            ?>
                        </li>
                    </ul>
-->
                </ul>
            </div>
        </div>
    </nav>  
        
    <?php

        $flash = $this->Session->flash();
        if(!empty($flash))
            echo '<script type="text/javascript">
                    Materialize.toast(\'<h5>'.$flash.'</h5>\', 3500);
                </script>';

        echo $this->fetch('content');

    ?>

<!--
    <footer class="page-footer">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">Footer Content</h5>
                    <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Links</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                        <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                © 2014 Copyright Text
                <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
        </div>
    </footer>
-->
</body>
</html>
