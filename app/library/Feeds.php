<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
 
class Feeds extends Component
{	
    public function getfeeds($url, $data, $start, $city='', $type=''){
    	$i = 1;
		foreach($data['results'] as $feed){
			if($i < 12){

			if(isset($feed['filter_type']) && $feed['filter_type'] == 'tags'){
				$gaattr = 'data-ga-cat="Entity Link Click on Tag Pages - '.$city.'" data-ga-action="Title | '.$feed['title'].'" data-ga-label="tag_results_pos_'. $i .'"';
			}else{
				$gaattr = 'data-ga-cat="Your Feed - '.$city.'" data-ga-action="Entity Type | '.$feed['title'].'" data-ga-label="feed_pos_'. $i .'"';
			}
			?>
			<?php if($i%9 != 0){ ?>
				<?php if(($start+$i) == 4 && $type=='feed' && $this->config->adtech->enableadtech == 1){ ?>
					<div class="col-sm-4 col-md-3 col-xs-6">
						<div class="feeds-data defaultads">
							<?php echo $this->getadtech($city); ?>
						</div>
					</div>	
				<?php } ?>
				<?php if(!isset($feed['is_sponsored'])){ ?>
					<div class="col-sm-4 col-md-3 col-xs-6">
						<div class="work-item feeds-data">
							<a href="<?php echo $url . $feed['url']; ?>" <?php echo $gaattr;?>>
								<div class="hover-container">
									<div class="hover-wrap">
										<i class="glyphicon glyphicon-plus bino"></i>
									</div>
									<?php echo $this->getimage($url, $feed['image']['uri'], 479, 479, $feed['title'], $feed['image'], '', '', $start+$i); ?>
								</div>
							</a>
							<a href="<?php echo $url . $feed['url']; ?>" <?php echo $gaattr;?>>
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
					<?php if($type == 'feed' || strtolower($feed['type']) == 'event'){ ?>
						<div class="col-sm-4 col-md-3 col-xs-6">
							<div class="work-item feeds-data">
								<a href="<?php echo $url . $feed['url']; ?>" <?php echo $gaattr;?>>
									<div class="hover-container">
										<div class="hover-wrap">
											<i class="glyphicon glyphicon-plus bino"></i>
										</div>
										<?php echo $this->getimage($url, $feed['image']['uri'], 479, 479, $feed['title'], $feed['image'], '', '', $start+$i); ?>
											<!--<div class="sponsors">Sponsored</div>-->
									</div>
								</a>
								<a href="<?php echo $url . $feed['url']; ?>"  <?php echo $gaattr;?>>
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


					<!--<div class="col-sm-4 col-md-3 col-xs-6">
						<a href="<?php echo $url . $feed['url']; ?>" data-ga-cat="feed" data-ga-action="<?php echo $url . $feed['url']; ?>" data-ga-label="pos_<?php echo $i; ?>">
							<div class="work-item withmask sponsor">
								<div class="the-box full no-border transparent no-margin make-up">
									<p class="feed-name"><?php //echo stripslashes($feed['title']); ?></p>
									<div class="sponsors"><?php echo $feed['label'];?></div>
								</div>
								<?php echo $this->getimage($url, $feed['image']['uri'], 479, 479, $feed['title'], $feed['image'], '', '', $start+$i); ?>
							</div>
						</a>
					</div>-->
				<?php }} ?>
			<?php
			} else {
			?>
				<div class="col-sm-4 col-md-6 col-xs-12">
					<a href="<?php echo $url . $feed['url']; ?>"  <?php echo $gaattr;?>>
						<div class="work-item withmask">
							<div class="the-box full no-border transparent no-margin make-up">
								<p class="feed-name"><?php echo stripslashes($feed['title']); ?></p>
							</div>
							<?php echo $this->getimage($url, $feed['image']['uri'], 479, 479, $feed['title'], $feed['image'], '', '', $start+$i); ?>
						</div>
					</a>
				</div>
			<?php
			}
			?>
				<?php if(strtoupper($feed['type']) == 'EVENT'){ ?>
					<script type="application/ld+json">
					{
						"@context": "http://schema.org",
						"@type" : "Event",
						"name" : "<?php echo $this->process_title($feed['title']); ?>",
						"image" : "<?php echo $feed['image']['uri']; ?>",
						"description" : "<?php echo htmlentities(strip_tags($feed['description'])); ?>",
						"url" : "<?php echo $url.$feed['url']; ?>",
						"location": {
							"@type" : "Place",
							"name" : "<?php echo $feed['venueDetail']['name']; ?>",
							"address" : "<?php echo $feed['venueDetail']['formatted_address']; ?>",
							"url" : "<?php echo $url.$feed['venueDetail']['url']; ?>"
						},
						"startDate": "<?php echo date('Y-m-d', $feed['start_time']); ?>"
					}
					</script>
				<?php }else if(strtoupper($feed['type']) == 'CONTENT'){ ?>
					
				<?php } ?>
			
			<?php
			}
			$i++;
		}
    }
	
	
	public function getfeedsforcoverimg($url, $data, $start)
    {	
    	$i = 1;
		foreach($data['results'] as $key=>$feed){
			?>
				<div class="col-sm-4 col-md-3 col-xs-6">
					<div class="work-item feeds-data">
						<a href="<?php echo $url . $feed['url']; ?>">
							<div class="hover-container">
								<div class="hover-wrap">
									<i class="glyphicon glyphicon-plus bino"></i>
								</div>
								<?php echo $this->getimage($url, $feed['cover_image'], 479, 479, $feed['title'], '', '', '', $start+$i); ?>
							</div>
						</a>
						<a href="<?php echo $url. $feed['url']; ?>">
						<div class="the-box no-margin no-border">
							<div class="feed-title"><?php echo $this->process_title($feed['title']); ?></div>
							<?php
								$desc = strip_tags($feed['description']);
								$description = strlen($desc) > 100 ? substr($desc, 0, 100).'...' : $desc;
							?>
							<div class="feed-short-desc"><?php echo $description; ?></div>
						</div>
						</a>
					</div>
				</div>
			<?php
			$i++;
		}
    }
	
	
	public function getfeedslist($baseUrl, $data, $city)
    {		
		foreach($data['results'] as $i=>$feed){
			if(!isset($feed['is_sponsored'])){ ?>
			<li class="media searchlist">
				<a class="pull-left" href="<?php echo $baseUrl . $feed['url']; ?>" data-ga-cat="Entity Link Click on Search Pages - <?php echo $city;?>" data-ga-action="Title | <?php echo $feed['title']; ?>" data-ga-label="search_results_pos_<?php echo $i+1; ?>">
					<?php echo $this->getimage($baseUrl, $feed['image']['uri'], 80, 80, $feed['title'], $feed['image'], '', '', $i); ?>
				</a>
				<a class="pull-left width100" href="<?php echo $baseUrl . $feed['url']; ?>" data-ga-cat="Entity Link Click on Search Pages - <?php echo $city;?>" data-ga-action="Title | <?php echo $feed['title']; ?>" data-ga-label="search_results_pos_<?php echo $i+1; ?>">
					<div class="media-body">
						<h4 class="media-heading">
							<?php
							if(strtoupper($feed['type']) == 'REVIEW'){
								echo stripslashes($feed['title']).' - Critic Review';
							}else{
								echo stripslashes($feed['title']);
							}
							?>
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
								if(isSet($feed['zonename']) && trim($feed['zonename'])!=''){
									$address_arr[] = $feed['zonename'];
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
				</a>
				<?php if(strtoupper($feed['type']) == 'EVENT'){ ?>
					<script type="application/ld+json">
					{
						"@context": "http://schema.org",
						"@type" : "Event",
						"name" : "<?php echo $this->process_title($feed['title']); ?>",
						"image" : "<?php echo $feed['image']['uri']; ?>",
						"description" : "<?php echo htmlentities(strip_tags($feed['description'])); ?>",
						"url" : "<?php echo $baseUrl.$feed['url']; ?>",
						"location": {
							"@type" : "Place",
							"name" : "<?php echo $feed['venueDetail']['name']; ?>",
							"address" : "<?php echo $feed['venueDetail']['formatted_address']; ?>",
							"url" : "<?php echo $baseUrl.$feed['venueDetail']['url']; ?>"
						},
						"startDate": "<?php echo date('Y-m-d', $feed['start_time']); ?>"
					}
					</script>
				<?php } ?>

			</li>										
		<?php }}
    }
	
	public function getcontest($url, $datas, $start, $city='', $type='', $isvoted){
		$i = 0;
		foreach($datas as $data){
			$imgclass = $class = '';
			$json_data = json_decode($data['data']);
			if($isvoted == $data['id']){
				$class = 'votedone';
				$imgclass = 'grayscale';
			}
			$i++;
			?>
				<div class="col-sm-4 col-md-3 col-xs-6">
					<div class="work-item feeds-data">
						<a href="<?php echo $url . $data['url']; ?>">
							<div class="hover-container">
								<div class="thanks_msg dnone">Thank you<br>for your vote</div>
								<div class="hover-wrap">
									<i class="glyphicon glyphicon-plus bino"></i>
								</div>
								<?php echo $this->getimage($url, $json_data->img, 479, 479, $data['title'], '', '', $imgclass, $start+$i); ?>
							</div>
						</a>
						<a href="<?php echo $url . $data['url']; ?>">
							<div class="the-box no-margin no-border">
								<div class="feed-title"><?php echo $data['title']; ?></div>
								<div class="feed-short-desc"><?php $desc = strip_tags($json_data->description);
								$description = strlen($desc) > 100 ? substr($desc, 0, 100).'...' : $desc; echo $description; ?></div>
								<div class="btn btn-primary voted <?php echo $class; ?>" rel="<?php echo $data['id']; ?>">VOTE NOW</div>
							</div>
						</a>
					</div>
				</div>
			<?php
		}
	}
	
	public function getimageendpoint(){
		$i = rand(0,5);
		$img_url='imgbaseUri'.$i;
		$url = $this->config->application->$img_url;
		return $url;
	}
	
	
	public function getimage($url, $image_url, $width, $height, $alt, $dimension='', $style='', $class='', $key=0, $type=''){
		$color = array('#fffae0', '#ffdddd', '#ddfcff', '#ffdef5', '#deffe4');
		$select_color = $key%4;
		$style = 'background-color:'.$color[$select_color].';'.$style;

		if($image_url){
			$pos = strpos($image_url, 'http');
			if($pos !== false){
				$imgurl = $image_url;
			}else{
				$imgurl = $this->getimageendpoint().$image_url;
			}


			if($type == 'banner'){
				$disdim = '&ca=1&cf=n&q=75';
			}else{
				$disdim = '&cc=1&q=75';
			}
			
			if(isset($dimension['x']) && isset($dimension['y'])){
				if($dimension['x'] == 0 && $dimension['y'] == 0){
					$parts = '?w='.$width.'&h='.$height.$disdim;
				}else{
					$parts = '?x='.$dimension['x'].'&y='.$dimension['y'].'&w='.$width.'&h='.$height.$disdim;
				}
			}else{
				$parts = '?w='.$width.'&h='.$height.$disdim;
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
			$class = 'lazy '.$class;
			//$style = 'background-color:#fff;'.$style;
			//$imgbox = '<img data-original="'.$imgurl.'" src="'.$url.'/img/transparent.png" alt="'.$alt.'" style="'.$style.'" class="'.$class.'">';
			$imgbox = '<img data-src="'.$imgurl.'"  data-src-retina="'.$imgurl.'" src="'.$url.'/img/transparent.png" alt="'.$alt.'" style="'.$style.'" class="'.$class.'">';
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

	public function getadtech($city){
		if($city == 'delhi-ncr' || $city == 'delhi ncr' || $city == 'Delhi NCR')
			$getcityadtech = 'delhincr';
		else
			$getcityadtech = strtolower($city);
		$adtech = $this->config->adtech->$getcityadtech;
		//return $this->getscriptandhtml($city, $adtech['id'], $adtech['url']);
		return $this->getscriptandhtml($city, 'div-gpt-ad-1434701665702-0', '/7176/WhatsHot/WhatsHot_Home/Whatshot_HP_NAT');
	}


	public function getscriptandhtml($city, $id, $url){
		//return "<iframe src='http://local.whatshot.in/ads.html'></iframe>";
		return "<script type='text/javascript' src=\"http://ad.crwdcntrl.net/5/c=2800/pe=y/var=_ccaud\"></script>
		<script type='text/javascript'>
		var googletag = googletag || {};
		googletag.cmd = googletag.cmd || [];
		(function() {
		var gads = document.createElement('script');
		gads.async = true;
		gads.type = 'text/javascript';
		var useSSL = 'https:' == document.location.protocol;
		gads.src = (useSSL ? 'https:' : 'http:') + 
		'//www.googletagservices.com/tag/js/gpt.js';
		var node = document.getElementsByTagName('script')[0];
		node.parentNode.insertBefore(gads, node);
		})();
		</script>

		<script type='text/javascript'>
		googletag.cmd.push(function() {

		var _auds = new Array();
		if(typeof(_ccaud)!='undefined') {
		for(var i=0;i<_ccaud.Profile.Audiences.Audience.length;i++)
		if(i<200)
		_auds.push(_ccaud.Profile.Audiences.Audience[i].abbr);
		}

		var _HDL = '';
		var _ARC1 = '';
		var _Hyp1 = '';
		var _article = '';
		var _tval = function(v) {
		if(typeof(v)=='undefined') return '';
		if(v.length>100) return v.substr(0,100);
		return v;
		}

		var mappingLeaderboard = googletag.sizeMapping().
		addSize([1, 1], [310, 457]).
		addSize([360, 200], [350, 497]).
		addSize([375, 200], [365, 513]).
		addSize([414, 200], [350, 497]).
		addSize([480, 200], [470, 617]).
		addSize([640, 200], [290, 437]).
		addSize([667, 200], [295, 442]).
		addSize([736, 200], [329, 477]).
		addSize([768, 200], [220, 367]).
		addSize([1024, 200], [230, 377]).
		addSize([1280, 200], [274, 427]).
		addSize([1366, 200], [274, 427]).
		build();

		var slot1 = googletag.defineSlot('".$url."', [[310, 457], [350, 497],[274, 427],[230, 377],[220, 367],[350, 497], [470, 617],[329, 477],[295, 442],[290, 437],[365, 513],[365, 513]], '".$id."').defineSizeMapping(mappingLeaderboard).addService(googletag.pubads());


		googletag.pubads().setTargeting('sg', _auds).setTargeting('HDL', _tval(_HDL)).setTargeting('ARC1', _tval(_ARC1)).setTargeting('Hyp1', _tval(_Hyp1)).setTargeting('article', _tval(_article));
		googletag.pubads().enableSingleRequest();
		googletag.pubads().collapseEmptyDivs();
		googletag.enableServices();
			window.addEventListener('resize', function () {
			    googletag.pubads().refresh([slot1]);
			});
		});
		</script>



		<div id='".$id."' style='position: absolute; top: 0px;'> 
		   <script>
		     googletag.cmd.push(function() {
		       googletag.display('".$id."');
		     });
		   </script> 
		</div>
		";
	}
}
