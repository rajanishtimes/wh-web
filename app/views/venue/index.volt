<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<h2 class="venuetitle">{{venuedetail['title']}}</h2>
				<div class="venuedetail">
					{% if(venuedetail['formatted_address'] != '') %}
						<div class="time"><div class="timeimg"></div><div class="width85 float-left">{{venuedetail['formatted_address']}}</div></div><div class="clearfix"></div>
					{% endif %}
					
					<?php
						$venuedetail['mobiledata'] = array_filter($venuedetail['mobiledata']);
						$venuedetail['phonedata'] = array_filter($venuedetail['phonedata']);
					?>
					{% if(venuedetail['mobiledata'] | length > 0 OR venuedetail['phonedata'] | length >  0) %}
						<div class="phone"><div class="phoneimg"></div>
							<div class="width85 float-left">
							<?php 
								echo implode(', ', $venuedetail['phonedata']);
								if(!empty($venuedetail['mobiledata']) && !empty($venuedetail['phonedata'])){
									echo ",";
								}
							?>
							<?php echo implode(', ', $venuedetail['mobiledata']);?>
							</div>
						</div><div class="clearfix"></div>
					{% endif %}
					
					{% if(venuedetail['landmark'] != '') %}
						<div class="landmark"><div class="landmarkimg"></div><div class="width85 float-left">{{venuedetail['landmark']}}</div></div><div class="clearfix"></div>
					{% endif %}
					
					{% if(venuedetail['website'] != '') %}
						<div class="website"><div class="websiteimg"></div><div class="width85 float-left"><a href="{{venuedetail['website']}}" target="_blank"><?php echo str_replace('http://','',$venuedetail['website'])?></a></div></div><div class="clearfix"></div>
					{% endif %}
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div id="map_canvas" style="width: 100%; height: 250px;"></div>
			</div><div class="clearfix"></div><div style="height:20px"></div>
		</div>

		
		<?php if(!empty($venuedetail['cuisines']) || (!empty($venuedetail['price_per'])) || (!empty($venuedetail['features'])) || !empty($venuedetail['images'][0]['uri'])){ ?>

		<div class="row service_container">
			<?php if(strtolower($venuedetail['venuetype']) == 'restaurant' || strtolower($venuedetail['venuetype']) == 'night life'){ ?>
			<div class="col-xs-12 col-sm-6 col-md-3 ">
				<ul class="list">
					<li class="service_group cuisine">Cuisine</li>
					<?php if(!empty($venuedetail['cuisines'])){ ?>
						<?php $one_dimension = array_map("serialize", $venuedetail['cuisines']);
								$unique_one_dimension = array_unique($one_dimension);
								$cuisines = array_map("unserialize", $unique_one_dimension);?>
						{% for key, cuisine in cuisines %}
							<li>{{cuisine['name']}}</li>
						{% endfor %}
					<?php }else{ ?>
						<li>N/A</li>
					<?php } ?>
				</ul>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3 ">
				<ul class="list">
					<li class="service_group cost">Cost</li>
					<?php if(!empty($venuedetail['price_per'])){ ?>
						<li><i class="fa fa-inr"></i>{{venuedetail['price_per']}} for two people (approx.)</li>
					<?php }else{ ?>
						<li>N/A</li>
					<?php } ?>
				</ul>
			</div>
			<?php } ?>
			<div class="col-xs-12 col-sm-6 col-md-3 ">
				<ul class="list faceilities_group">
					<li class="service_group facilities">Facilities</li>
					<?php $features = $venuedetail['features']; ?>
					<?php if(!empty($features)){ ?>
						{% for key, feature in features %}
							<li class="{{elements.remove_space(feature['name']) | lower}}">{{feature['name']}}</li>
						{% endfor %}
					<?php }else{ ?>
						<li class="facility-na">N/A</li>
					<?php } ?>
				</ul>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<?php if (!empty($venuedetail['images'][0]['uri'])) { ?>
					<div class="view_gallery" title="Click to see Full Gallery">
						{{feeds.getimage(baseUrl, venuedetail['images'][0]['uri'], 480, 480, venuedetail['title'], '', '', 'img-detail', 0)}} 
						<div class="view-gallery">VIEW GALLERY</div>
					</div>
				<?php } ?>
				
			</div>
		</div>
		<?php } ?>

		{% if(venuedetail['reviews'][0] is defined) %}
		<div class="col-xs-12 no-padding">
			<h2 class="yfeeds">Critic Review</h2>
		</div><div class="clearfix"></div>
		<div class="critic_review_container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-4">
					<div class="authordata">
						<div class="author-image float-left">
							{{feeds.getimage(baseUrl, venuedetail['reviews'][0]['author']['images'][0]['uri'], 100, 100, venuedetail['reviews'][0]['author']['title'], venuedetail['reviews'][0]['author']['images'], 'width:100px; height:100px; border-radius: 50%; margin: 0px auto;', 'img-detail icon-circle')}}
						</div>
						<div class="authordetail float-left">
							<h2 class="reviewtitle text-center"><span class="reviewd">Reviewed by</span><br> <a href="{{baseUrl}}{{venuedetail['reviews'][0]['url']}}">{{venuedetail['reviews'][0]['author']['title'] | lower | capitalize}}</a></h2>
							{% if(venuedetail['reviews'][0]['author']['twitter_url'] != '') %}
								<a href="https://twitter.com/{{venuedetail['reviews'][0]['author']['twitter_url']}}" class="twitter-follow-button" data-show-count="true"></a>
							{% endif %}
						</div>
					</div><br>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6">
					<div class="rating-container text-center">
						<!--<div class="rating-div float-left">
							<div class="total-rate">
								{{venuedetail['reviews'][0]['rwidth']}}
							</div>
							<div class="overall-rate">
								OUT OF 5
							</div>
						</div>-->
						<div class="progressbar float-left">
							{% for key, rating in venuedetail['reviews'][0]['rating'] %}
							<div class="progres-bar">
								<div class="text-color float-left"><div class="rate-text float-left">{{rating['title']}}</div></div>
								<div class="progress-container">
									<div class="single-color"></div>
									<div class="multi-color" style="background-color:{{rating['background_color']}}; border-color:{{rating['border_color']}}; width:{{rating['width']}}%"></div>
								</div>
								<div class="text-color float-right"><div class="overall-span float-right">{{rating['rating']}}/5</div></div>
							</div>
							{% endfor %}
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="col-md-2">
				</div>
			</div>
			
			<!--<h2 class="contenttitle text-left">{{venuedetail['reviews'][0]['estIdData'][0]['text'] | stripslashes}}</h2>-->		
			<div class="detail">
				<?php
					$review = strip_tags($venuedetail['reviews'][0]['description']);
					$critic_description = strlen($review) > 800 ? substr($review, 0, 800).' <a href="'.$baseUrl.$venuedetail['reviews'][0]['url'].'">Read More...</a>' : $review; ?>
					{{critic_description}}
			</div>

		</div>
		{% endif %}
		<div class="clearfix"></div><br/>
		<div class="share venue_share">
			<ul class="list-inline navbar-left">
				<li><a onclick="window.open('https://twitter.com/share?url={{baseUrl}}{{venuedetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="twitter-icon"><i class="fa fa-twitter"></i>&nbsp;<span>Share</span></div></a></li>
				<li><a onclick="window.open('http://www.facebook.com/sharer/sharer.php?u={{baseUrl}}{{venuedetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="fb-icon"><i class="fa fa-facebook"></i>&nbsp;<span>Share</span></div></a></li>
				<li><a onclick="window.open('https://plus.google.com/share?url={{baseUrl}}{{venuedetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="google-icon"><i class="fa fa-google-plus"></i>&nbsp;<span>Share</span></div></a></li>
			</ul><div class="clearfix"></div>
		</div>

		<?php if(!empty($events['results'])){ ?>
			<div class="upcoming_event">
				<div class="col-sm-12 col-md-12">
				<div class="row">
					<div class="col-xs-12 no-padding">
						<h2 class="yfeeds">Ongoing and Upcoming Events</h2>
					</div>
					<div class="row work-content">
						<div id="getupcomingevents">
							{{feeds.getfeeds(baseUrl, events, 0, cityshown, 'venue')}}
						</div><div class="clearfix"></div>
					</div>
				</div>
				</div>
			</div>
		<?php } ?>

		<?php if(!empty($pastevents['results'])){ ?>
			<div class="upcoming_event">
				<div class="col-sm-12 col-md-12">
				<div class="row">
					<div class="col-xs-12 no-padding">
						<h2 class="yfeeds">Past Events</h2>
					</div>
					<div class="row work-content">
						<div id="getupcomingevents">
								{{feeds.getfeeds(baseUrl, pastevents, 0, cityshown, 'venue')}}
						</div><div class="clearfix"></div>
					</div>
				</div>
				</div>
			</div>
		<?php } ?>

		<?php if(!empty($nearbyevents['results'])){ ?>
			<div class="nearby_events">
				<div class="col-sm-12 col-md-12">
				<div class="row">
					<div class="col-xs-12 no-padding">
						<h2 class="yfeeds">Nearby places</h2>
					</div>
					<div class="row work-content">
						<div id="getupcomingevents">
							<?php $i= 1; foreach($nearbyevents['results'] as $feed){ ?>
							<div class="col-sm-4 col-md-3 col-xs-6">
								<div class="work-item feeds-data">
									<a href="<?php echo $baseUrl . $feed['url']; ?>">
										<div class="hover-container">
											<div class="hover-wrap">
												<i class="glyphicon glyphicon-plus bino"></i>
											</div>
											<?php echo $this->feeds->getimage($baseUrl, $feed['image']['uri'], 479, 479, $feed['title'], $feed['image'], '', '', $i); ?>
										</div>
									</a>
									<a href="<?php echo $baseUrl . $feed['url']; ?>">
										<div class="the-box no-margin no-border">
											<div class="feed-title"><?php echo $this->feeds->process_title($feed['title']); ?></div>
											<div class="homepagevenue">
												<div class="landmark"><?php echo $feed['formatted_address']; ?></div>
											</div>
										</div>
									</a>
								</div>
							</div>
							<?php $i++; } ?>
						</div><div class="clearfix"></div>
					</div>
				</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
<?php if(!empty($venuedetail['images'])){ ?>
function eventimages(){
	$.swipebox([
		{% for key, images in venuedetail['images'] %}
			{ href:'{{feeds.makeurl(baseUrl, images["uri"])}}', title:'{{venuedetail["title"] | slashes}}' },
		{% endfor  %}
	]);
}
<?php } ?>

//<![CDATA[
var map;
var center = new google.maps.LatLng({{venuedetail['latitude']}}, {{venuedetail['longitude']}});
 
function init() {
	 
	var mapOptions = {
		zoom: 13,
		center: center,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}
	 
	map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
	 
	var marker = new google.maps.Marker({
		map: map, 
		position: center,
	});
}
//]]>
init();
</script>