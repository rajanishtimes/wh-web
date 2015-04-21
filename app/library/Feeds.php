<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Feeds extends Component
{

    public function getfeeds($url, $data)
    {		
		foreach($data['results'] as $feed){
			?>
				<div class="col-sm-4 col-md-3 col-xs-6">
					<div class="work-item">
						<a href="<?php echo $url . $feed['url']; ?>">
							<?php if($feed['image']['uri']){ ?>
								<img src="<?php echo $feed['image']['uri']; ?>" alt="<?php echo $feed['title'] ?>">
							<?php }else{?>
								<?php echo $this->imagenotfound($url, $feed['title']); ?>
							<?php }?>
						</a>
						<div class="the-box no-margin">
							<div class="feed-title"><a href="<?php echo $url. $feed['url']; ?>"><?php echo $feed['title']; ?></a></div>
							<p class="feed-short-desc"><?php echo $feed['description']; ?></p>
						</div>
					</div>
				</div>
			<?php
		}
    }
	
	
	public function getfeedsforcoverimg($url, $data)
    {		
		foreach($data['results'] as $feed){
			?>
				<div class="col-sm-4 col-md-3 col-xs-6">
					<div class="work-item">
						<a href="<?php echo $url . $feed['url']; ?>">
							<?php if($feed['cover_image']){ ?>
								<img src="<?php echo $feed['cover_image'] ?>" alt="<?php echo $feed['title']; ?>">
							<?php }else{ ?>
								<?php echo $this->imagenotfound($url, $feed['title']); ?>
							<?php } ?>
						</a>
						<div class="the-box no-margin">
							<div class="feed-title"><a href="<?php echo $url. $feed['url']; ?>"><?php echo $feed['title']; ?></a></div>
						</div>
					</div>
				</div>
			<?php
		}
    }
	
	
	private function imagenotfound($url, $alt){
		$imgbox = '<img src="'.$url.'img/img_feed_default.png" alt="'.$alt.'">';
		return $imgbox;
	}
}
