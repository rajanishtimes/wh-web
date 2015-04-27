<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Feeds extends Component
{

    public function getfeeds($url, $data, $start)
    {	$i = 1;
		foreach($data['results'] as $feed){
			if($i%9 != 0){
			?>
				<div class="col-sm-4 col-md-3 col-xs-6">
					<div class="work-item">
						<a href="<?php echo $url . $feed['url']; ?>" data-ga-cat="feed" data-ga-action="<?php echo $url . $feed['url']; ?>" data-in-label="pos_<?php echo $i; ?>">
							<div class="hover-wrap">
								<i class="glyphicon glyphicon-plus fa fa-eye"></i>
							</div>
						</a>
						<a href="<?php echo $url . $feed['url']; ?>" data-ga-cat="feed" data-ga-action="<?php echo $url . $feed['url']; ?>" data-in-label="pos_<?php echo $i; ?>">
							<?php echo $this->getimage($url, $feed['image']['uri'], 480, 480, $feed['title']); ?>
						</a>
						<div class="the-box no-margin">
							<div class="feed-title"><a href="<?php echo $url. $feed['url']; ?>"><?php echo $feed['title']; ?></a></div>
							<?php if(strtoupper($feed['type']) == 'EVENT'){ ?>
								<div class="homepagevenue">
									<div class="time"><?php echo $feed['time']; ?></div>
									<div class="landmark"><?php echo $feed['venue']; ?></div>
								</div>
							<?php }else{ ?>
								<div class="feed-short-desc"><?php echo $feed['description']; ?></div>
							<?php }?>
						</div>
						<?php if(strtolower($feed['label']) == 'sponsored'){ ?>
							<div class="sponsors">Sponsors</div>
						<?php } ?>
					</div>
				</div>
			<?php
			}else{
			?>
				<div class="col-sm-12 col-md-6 col-xs-6">
					<a href="<?php echo $url . $feed['url']; ?>" data-ga-cat="feed" data-ga-action="<?php echo $url . $feed['url']; ?>" data-in-label="pos_<?php echo $i; ?>">
						<div class="work-item withmask">
							<div class="the-box full no-border transparent no-margin make-up">
								<p class="feed-name"><?php echo $feed['title']; ?></p>
							</div>
							<?php echo $this->getimage($url, $feed['image']['uri'], 480, 480, $feed['title']); ?>
						</div>
					</a>
				</div>
			<?php
			}
			$i++;
		}
    }
	
	
	public function getfeedsforcoverimg($url, $data)
    {		
		foreach($data['results'] as $feed){
			?>
				<div class="col-sm-4 col-md-3 col-xs-6">
					<div class="work-item">
						<a href="<?php echo $url . $feed['url']; ?>">
							<div class="hover-wrap">
								<i class="glyphicon glyphicon-plus fa fa-eye"></i>
							</div>
						</a>
						<a href="<?php echo $url . $feed['url']; ?>">
							<?php echo $this->getimage($url, $feed['cover_image'], 480, 480, $feed['title']); ?>
						</a>
						<div class="the-box no-margin">
							<div class="feed-title"><a href="<?php echo $url. $feed['url']; ?>"><?php echo $feed['title']; ?></a></div>
							<div class="feed-short-desc"><?php echo $feed['description']; ?></div>
						</div>
					</div>
				</div>
			<?php
		}
    }
	
	
	public function getfeedslist($baseUrl, $data)
    {		
		foreach($data['results'] as $i=>$feed){ ?>
			<li class="media searchlist">
				<a class="pull-left" href="<?php echo $baseUrl . $feed['url']; ?>" data-ga-cat="search" data-ga-action="<?php echo $baseUrl . $feed['url']; ?>" data-in-label="pos_<?php echo $i+1; ?>">
					<?php echo $this->getimage($baseUrl, $feed['image']['uri'], 100, 100, $feed['title'], $feed['image']); ?>
				</a>
				<div class="media-body">
					<h4 class="media-heading">
						<a href="<?php echo $baseUrl. $feed['url']; ?>" data-ga-cat="search" data-ga-action="<?php echo $baseUrl . $feed['url']; ?>" data-in-label="pos_<?php echo $i+1; ?>"><?php echo $feed['title']; ?></a>
					</h4>
					<p class="small">
						<?php //echo $feed['type']; ?>
					</p>
					<?php if(strtoupper($feed['type']) == 'EVENT'){ ?>
						<div class="homepagevenue">
							<div class="time"><?php echo $feed['time']; ?></div>
							<div class="landmark"><?php echo $feed['venue']; ?></div>
						</div>
					<?php }else{ ?>
						<p class="feed-short-desc"><?php echo $feed['description']; ?></p>
					<?php }?>
				</div>
			</li>										
		<?php }
    }
	
	
	public function getimageendpoint(){
		$i = rand(0,5);
		$img_url='imgbaseUri'.$i;
		$url = $this->config->application->$img_url;
		return $url;
	}
	
	public function getimage($url, $image_url, $width, $height, $alt, $dimension='', $style='', $class=''){
		if($image_url){
			$pos = strpos($image_url, 'http');
			if($pos !== false){
				$imgurl = $image_url.'?w='.$width.'&h='.$height.'&c=1';
			}else{
				$imgurl = $this->getimageendpoint().$image_url.'?w='.$width.'&h='.$height.'&c=1';
			}
			$imgbox = '<img src="'.$imgurl.'" alt="'.$alt.'" style="'.$style.'" class="'.$class.'">';
		}else{
			$imgbox = '<img src="'.$url.'img/img_feed_default.png" alt="'.$alt.'"  style="'.$style.'" class="'.$class.'">';
		}
		return $imgbox;
	}
	
	public function imagenotfound($url, $alt){
		$imgbox = '<img src="'.$url.'img/img_feed_default.png" alt="'.$alt.'">';
		return $imgbox;
	}
}
