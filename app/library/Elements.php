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
            
        ),
        'navbar-right' => array(
			'terms' => array(
                'caption' => 'Terms and Conditions',
                'action' => '#'
            ),
            'privacy' => array(
                'caption' => 'Privacy Policy',
                'action' => '#'
            )
        )
    );
	
	private $_navmenu = array(        
		'site-map' => array(
			'caption' => 'Site Map',
			'action' => '#'
		),
		'help' => array(
			'caption' => 'Help',
			'action' => '#'
		),
		'careers' => array(
			'caption' => 'Careers',
			'action' => '#'
		),
		'user-agreement' => array(
			'caption' => 'User Agreement',
			'action' => '#'
		),
		'policy' => array(
			'caption' => 'Policy',
			'action' => '#'
		),
		'payment-info' => array(
			'caption' => 'Payment Info',
			'action' => '#'
		)
    );

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
	
	public function getStaticpages()
    {
		$actionName = $this->view->getActionName();
		echo "<ul class='list'>";
		foreach ($this->_navmenu as $action => $option) {
			if ($actionName == $action) {
				echo '<li class="active">';
			} else {
				echo '<li>';
			}
			echo $this->tag->linkTo($option['action'], $option['caption']);
			echo '</li>';
		}
		echo '</ul>';

    }
}
