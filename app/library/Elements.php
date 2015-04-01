<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Elements extends Component
{

    private $_headerMenu = array(
        'navbar-left' => array(
            'terms' => array(
                'caption' => 'Terms',
                'action' => '#'
            ),
            'privacy' => array(
                'caption' => 'Privacy',
                'action' => '#'
            ),
            'facebook' => array(
                'caption' => 'Facebook',
                'action' => '#'
            ),
            'twitter' => array(
                'caption' => 'Twitter',
                'action' => '#'
            ),
        ),
        'navbar-right' => array(
		
        )
    );

    /**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getMenu()
    {
		$controllerName = $this->view->getControllerName();
        foreach ($this->_headerMenu as $position => $menu) {
            echo "<ul class='list-inline ".$position."'>";
            foreach ($menu as $controller => $option) {
                if ($controllerName == $controller) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                echo $this->tag->linkTo($controller . '/' . $option['action'], $option['caption']);
                echo '</li>';
            }
            echo '</ul>';
        }

    }
}
