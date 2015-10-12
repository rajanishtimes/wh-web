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
		'about-us' => array(
			'caption' => 'About Us',
			'action' => 'about-us'
		),
		'advertise' => array(
			'caption' => 'Advertise on What\'s Hot',
			'action' => 'advertise'
		),
		'terms' => array(
			'caption' => 'Terms and Conditions',
			'action' => 'terms'
		),
		'policy' => array(
			'caption' => 'Privacy Policy',
			'action' => 'policy'
		)
    );

    public function getMenu($url, $city)
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
                echo '<a href="'.$url.'/'.$option['action'].'">'.$option['caption'].'</a>';
                echo '</li>';
            }
            if($position == 'navbar-right')
            echo '<li><a href="'.$url.'/'.$city.'/feed">RSS</a></li>';
            echo '</ul>';
        }

    }
	
	public function getStaticpages($url, $city, $currentCity)
    {
		$actionName = $this->view->getActionName();
		echo "<ul class='list-inline footer-list'>";
		foreach ($this->_navmenu as $action => $option) {
			if($action == 'advertise'){
				echo '<li><a href="mailto:advertise@whatshot.in?subject=Advertise on What\'s Hot" class="makeaactive">'.$option['caption'].'</a></li>';
			}else {
				if ($actionName == $action) {
					echo '<li class="active">';
				} else {
					echo '<li>';
				}
				echo '<a href="'.$url.'/'.$option['action'].'">'.$option['caption'].'</a>';
				echo '</li>';
			}
		}
		echo '<li><a href="'.$url.'/'.$city.'/feed">RSS</a></li>';
		echo '<li><a href="mailto:pingsocial@whatshot.in?subject=Promote my event on What\'s Hot">Promote your Event</a></li>';
		echo '</ul>';

    }
	
	
	public function imgnotfound($url, $alt){
		$imgbox = '<img src="'.$url.'img/img_feed_default.png" alt="'.$alt.'">';
		return $imgbox;
	}
	
	public function create_slug($string){
		//$slug=str_replace(' ', '-', trim($string));
		$string = preg_replace('/\s+/', ' ',$string);
		$slug2=urlencode(trim($string));
		return $slug2;
	}

	public function create_title($string){
		$slug2 = urldecode(trim($string));
		//$slug2 = str_replace('-', ' ', $slug);
		return $slug2;
	}

	public function toslug($str) {
		$clean = preg_replace("/[^a-zA-Z0-9\/_|+() -]/", '', $str);
		$clean = strtolower(trim($clean, '-'));
		$clean = preg_replace("/[\/_|+ -()]+/", '-', $clean);
		$clean = strtolower(trim($clean, '-'));
		return $clean;
	}

	public function remove_space($string){
		$slug = str_replace(' ', '-', $string);
		$slug2 = str_replace('/', '-', $slug);
		return $slug2;
	}

	public function auto_version($file, $ROOT=false){

		if(!$ROOT){
			$ROOT = APP_PATH . 'public';
		}

		if(strpos($file, '/') !== 0 || !file_exists( $ROOT . $file)){
			return $file;
		}
		
		$mtime = filemtime($ROOT . $file);
		$mtime = floor($mtime / 100) ;
		return preg_replace('{\\.([^./]+)$}', ".$mtime.\$1", $file);
	}

	public function friendlyTime($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

}
