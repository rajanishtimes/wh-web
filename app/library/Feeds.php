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
				<?php if(strtolower($feed['label']) != 'sponsored'){ ?>
				<div class="col-sm-4 col-md-3 col-xs-6">
					<div class="work-item feeds-data">
						<a href="<?php echo $url . $feed['url']; ?>" data-ga-cat="feed" data-ga-action="<?php echo $url . $feed['url']; ?>" data-in-label="pos_<?php echo $i; ?>">
							<div class="hover-wrap">
								<i class="glyphicon glyphicon-plus bino"></i>
							</div>
						</a>
						<a href="<?php echo $url . $feed['url']; ?>" data-ga-cat="feed" data-ga-action="<?php echo $url . $feed['url']; ?>" data-in-label="pos_<?php echo $i; ?>">
							<?php echo $this->getimage($url, $feed['image']['uri'], 480, 480, $feed['title'], $feed['image']); ?>
						</a>
						<a href="<?php echo $url . $feed['url']; ?>" data-ga-cat="feed" data-ga-action="<?php echo $url . $feed['url']; ?>" data-in-label="pos_<?php echo $i; ?>">
							<div class="the-box no-margin no-border">
								<div class="feed-title"><?php echo $this->process_title($feed['title']); ?></div>
								<?php if(strtoupper($feed['type']) == 'EVENT'){ ?>
									<div class="homepagevenue">
										<div class="time"><?php echo $feed['time']; ?></div>
										<div class="landmark"><?php echo $feed['venue']; ?></div>
									</div>
								<?php }else{ ?>
									<div class="feed-short-desc"><?php echo strip_tags($feed['description'], '<a>'); ?></div>
								<?php }?>
							</div>
						</a>
					</div>
				</div>
				<?php }else{ ?>
					<div class="col-sm-4 col-md-3 col-xs-6">
						<a href="<?php echo $url . $feed['url']; ?>" data-ga-cat="feed" data-ga-action="<?php echo $url . $feed['url']; ?>" data-in-label="pos_<?php echo $i; ?>">
							<div class="work-item withmask sponsor">
								<div class="the-box full no-border transparent no-margin make-up">
									<p class="feed-name"><?php //echo stripslashes($feed['title']); ?></p>
									<div class="sponsors">Sponsors</div>
								</div>
								<?php echo $this->getimage($url, $feed['image']['uri'], 480, 480, $feed['title'], $feed['image']); ?>
							</div>
						</a>
					</div>
				<?php } ?>
			<?php
			}else{
			?>
				<div class="col-sm-4 col-md-6 col-xs-12">
					<a href="<?php echo $url . $feed['url']; ?>" data-ga-cat="feed" data-ga-action="<?php echo $url . $feed['url']; ?>" data-in-label="pos_<?php echo $i; ?>">
						<div class="work-item withmask">
							<div class="the-box full no-border transparent no-margin make-up">
								<p class="feed-name"><?php echo stripslashes($feed['title']); ?></p>
							</div>
							<?php echo $this->getimage($url, $feed['image']['uri'], 480, 480, $feed['title'], $feed['image']); ?>
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
					<div class="work-item feeds-data">
						<a href="<?php echo $url . $feed['url']; ?>" data-ga-cat="feed" data-ga-action="<?php echo $url . $feed['url']; ?>" data-in-label="pos_<?php echo $i; ?>">
							<div class="hover-wrap">
								<i class="glyphicon glyphicon-plus bino"></i>
							</div>
						</a>
						<a href="<?php echo $url . $feed['url']; ?>">
							<?php echo $this->getimage($url, $feed['cover_image'], 480, 480, $feed['title']); ?>
						</a>
						<div class="the-box no-margin no-border">
							<div class="feed-title"><a href="<?php echo $url. $feed['url']; ?>"><?php echo $this->process_title($feed['title']); ?></a></div>
							<?php
								$desc = strip_tags($feed['description']);
								$description = strlen($desc) > 100 ? substr($desc, 0, 100).'...' : $desc;
							?>
							<div class="feed-short-desc"><?php echo $description; ?></div>
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
					<?php echo $this->getimage($baseUrl, $feed['image']['uri'], 80, 80, $feed['title'], $feed['image'], '', ''); ?>
				</a>
				<div class="media-body">
					<h4 class="media-heading">
						<a href="<?php echo $baseUrl. $feed['url']; ?>" data-ga-cat="search" data-ga-action="<?php echo $baseUrl . $feed['url']; ?>" data-in-label="pos_<?php echo $i+1; ?>"><?php echo $this->process_title($feed['title']); ?></a>
					</h4>
					<p class="small">
						<?php //echo $feed['type']; ?>
					</p>
					<?php if(strtoupper($feed['type']) == 'EVENT'){ ?>
						<div class="homepagevenue">
							<div class="time"><?php echo $feed['time']; ?></div>
							<div class="landmark"><?php echo $feed['venue']; ?></div>
						</div>
					<?php }else if(strtoupper($feed['type']) == 'VENUE'){ ?>
						<?php 
							$address_arr = array();
							if(isSet($feed['address']) && trim($feed['address'])!=''){
								$address_arr[] = $feed['address'];
							}
							if(isSet($feed['landmark']) && trim($feed['landmark'])!=''){
								$address_arr[] = $feed['landmark'];
							}
							if(isSet($feed['locality']) && trim($feed['locality'])!=''){
								$address_arr[] = $feed['locality'];
							}
							if(isSet($feed['cities']) && trim($feed['cities'])!=''){
								$address_arr[] = $feed['cities'];
							}
							echo $formatted_address = implode(', ', $address_arr);
						?>
					<?php }else{ ?>
						<p class="feed-short-desc"><?php echo strip_tags($feed['description'], '<a>'); ?></p>
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
				$imgurl = $image_url;
			}else{
				$imgurl = $this->getimageendpoint().$image_url;
			}
			
			if(isset($dimension['x']) && isset($dimension['y'])){
				if($dimension['x'] == 0 && $dimension['y'] == 0){
					$parts = '?w='.$width.'&h='.$height.'&cc=1&q=75';
				}else{
					$parts = '?x='.$dimension['x'].'&y='.$dimension['y'].'&w='.$width.'&h='.$height.'&c=1&q=75';
				}
			}else{
				$parts = '?w='.$width.'&h='.$height.'&cc=1&q=75';
			}
			
			
			/* if($type == 'rectangle'){
				$size = getimagesize($imgurl);
				$original_width = $size[0];
				$original_height = $size[1];
				
				if($original_width > $width && $width != 0){
					$x = ($original_width - $width)/2;
				}
				
				if($original_height > $height  && $height != 0){
					$y = ($original_height - $height)/2;
				}
				$parts = '?x='.$x.'&y='.$y.'&w='.$width.'&h='.$height.'&c=1&q=75';
			} */
			
			$imgurl = $imgurl.$parts;
			$imgbox = '<img src="'.$imgurl.'" alt="'.$alt.'" style="'.$style.'" class="'.$class.'">';
		}else{
			$imgbox = '<img src="'.$url.'/img/img_feed_default.png" alt="'.$alt.'"  style="'.$style.'" class="'.$class.'">';
		}
		return $imgbox;
	}
	
	public function imagenotfound($url, $alt){
		$imgbox = '<img src="'.$url.'/img/img_feed_default.png" alt="'.$alt.'">';
		return $imgbox;
	}
	
	public function makeurl($url, $image_url){
		if($image_url == ''){
			$imgurl = $url.'/img/img_feed_default.png';
		}else{
			$pos = strpos($image_url, 'http');
			if($pos !== false){
				$imgurl = $image_url;
			}else{
				$imgurl = $this->getimageendpoint().$image_url;
			}
		}		
		return $imgurl;
	}
	
	public function process_title($title){
		$title = stripslashes($title);
		$p_title = strlen($title) > 20 ? substr($title, 0, 20).'...' : $title;
		return $p_title;
	}
}
