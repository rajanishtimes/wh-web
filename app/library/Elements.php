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
	
	public function getStaticpages($url, $city)
    {
		$actionName = $this->view->getActionName();
		echo "<ul class='list'>";
		foreach ($this->_navmenu as $action => $option) {
			if ($actionName == $action) {
				echo '<li class="active">';
			} else {
				echo '<li>';
			}
			echo '<a href="'.$url.'/'.$option['action'].'">'.$option['caption'].'</a>';
			echo '</li>';
		}
		echo '<li><a href="'.$url.'/'.$city.'/feed">RSS</a></li>';
		echo '</ul>';

    }
	
	
	public function imgnotfound($url, $alt){
		$imgbox = '<img src="'.$url.'img/img_feed_default.png" alt="'.$alt.'">';
		return $imgbox;
	}
	
	public function create_slug($string){
		//$slug=str_replace(' ', '-', trim($string));
		$slug2=urlencode(trim($string));
		return $slug2;
	}

	public function create_title($string){
		$slug2 = urldecode(trim($string));
		//$slug2 = str_replace('-', ' ', $slug);
		return $slug2;
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

	public function friendlyTime($time)
    {
        $second = 1;
        $minute = 60 * $second;
        $hour = 60 * $minute;
        $day = 24 * $hour;
        $month = 30 * $day;

        $delta = time() - strtotime($time);

        if ($delta < 1 * $minute)
            return $delta == 1 ? "one second ago" : $delta . " seconds ago";
        if ($delta < 2 * $minute)
            return "a minute ago";
        if ($delta < 45 * $minute)
            return floor($delta / $minute) . " minutes ago";
        if ($delta < 90 * $minute)
            return "an hour ago";
        if ($delta < 24 * $hour)
            return floor($delta / $hour) . " hours ago";
        if ($delta < 2 * $day)
        	return "a day ago";
        if($delta < 7 * $day)
            return floor($delta / $day) . " days ago";
        if($delta < 14 * $day)
        	return "a week ago";
        if($delta < 28 * $day)
        	return floor($delta / (7*$day)) . " weeks ago";
        if($delta < 45 * $day)
        	return "a month ago"; 
        if($delta < 60 * $day)
        	return " two months ago";
        if($delta < 12 * $month)
        	return floor($delta / $month) . " months ago";
        
        if (date('Y') == date('Y',  strtotime($time)))
        {   
            return date('jS F', strtotime ($time));
        }

        // for times older than an year return in the format '31st Aug, 2010'
        return date('F jS, Y', strtotime($time));
    }

}
