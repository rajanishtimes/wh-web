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
						<a href="<?php echo $url . $feed['url']; ?>">
							<div class="hover-wrap">
								<i class="glyphicon glyphicon-plus fa fa-eye"></i>
							</div>
						</a>
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
						<?php if(strtolower($feed['label']) == 'sponsored'){ ?>
							<div class="sponsors">Sponsors</div>
						<?php } ?>
					</div>
				</div>
			<?php
			}else{
			?>
				<div class="col-sm-12 col-md-6 col-xs-6">
					<a href="<?php echo $url . $feed['url']; ?>">
						<div class="work-item withmask">
							<div class="the-box full no-border transparent no-margin make-up">
								<p class="feed-name"><?php echo $feed['title']; ?></p>
							</div>
							<?php if($feed['image']['uri']){ ?>
								<img src="<?php echo $feed['image']['uri']; ?>" alt="<?php echo $feed['title'] ?>">
							<?php }else{?>
								<?php echo $this->imagenotfound($url, $feed['title']); ?>
							<?php }?>
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
	
	
	public function getfeedslist($baseUrl, $data)
    {		
		foreach($data['results'] as $feed){ ?>
			<li class="media">
				<a class="pull-left" href="<?php echo $baseUrl . $feed['url']; ?>">
					<?php echo $this->getimage($baseUrl, $feed['image']['uri'], 100, 100, $feed['title'], $feed['image']); ?>
				</a>
				<div class="media-body">
					<h4 class="media-heading">
						<a href="<?php echo $baseUrl. $feed['url']; ?>"><?php echo $feed['title']; ?></a>
					</h4>
					<p class="small">
						<?php echo $feed['type']; ?>
					</p>
					<p>
						<?php echo $feed['description']; ?>
					</p>
				</div>
			</li>										
		<?php }
    }
	
	public function getimage($url, $image_url, $width, $height, $alt, $dimension){
		if($image_url){
			$pos = strpos($image_url, 'http');
			if($pos === false){
				$imgurl = $this->config->application->imgbaseUri.$image_url;
			}else{
				$imgurl = $image_url;
			}
			$imgbox = '<img src="'.$imgurl.'" alt="'.$alt.'">';
		}else{
			$imgbox = '<img src="'.$url.'img/img_feed_default.png" alt="'.$alt.'">';
		}
		return $imgbox;
	}
	
	public function imagenotfound($url, $alt){
		$imgbox = '<img src="'.$url.'img/img_feed_default.png" alt="'.$alt.'">';
		return $imgbox;
	}
}
