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
                'action' => 'terms'
            ),
            'policy' => array(
                'caption' => 'Privacy Policy',
                'action' => 'policy'
            )
        )
    );
	
	private $_navmenu = array(        
		'terms' => array(
			'caption' => 'Terms and Conditions',
			'action' => 'terms'
		),
		'policy' => array(
			'caption' => 'Privacy Policy',
			'action' => 'policy'
		),
		'about-us' => array(
			'caption' => 'About Us',
			'action' => 'about-us'
		),
    );

    public function getMenu($url)
    {
		$controllerName = $this->view->getControllerName();
        foreach ($this->_headerMenu as $position => $menu) {
            echo "<ul class='list-inline ".$position."  text-left'>";
            foreach ($menu as $controller => $option) {
                if ($controllerName == $controller) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                echo '<a href="'.$url.$option['action'].'">'.$option['caption'].'</a>';
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
	
	
	public function imgnotfound($url, $alt){
		$imgbox = '<img src="'.$url.'img/img_feed_default.png" alt="'.$alt.'">';
		return $imgbox;
	}
}
