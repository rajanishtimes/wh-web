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

		<div class="row service_container">
			<div class="col-xs-12 col-sm-6 col-md-3 ">
				<ul class="list">
					<li class="service_group cuisine">Cuisine</li>
					<li>Italian</li>
					<li>Chinese</li>
					<li>Indian</li>
				</ul>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3 ">
				<ul class="list">
					<li class="service_group cost">Cost</li>
					<li><i class="fa fa-inr"></i> 1400 for two people (aprox.)</li>
				</ul>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3 ">
				<ul class="list faceilities_group">
					<li class="service_group facilities">Facilities</li>
					<li class="{{'Non-Veg' | lower}}">Non Veg</li>
					<li class="{{'Alcohol' | lower}}">Alcohol</li>
					<li class="{{'Buffet' | lower}}">Buffet</li>
				</ul>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3">
				<div class="view_gallery" title="Click to see Full Gallery">
						{{feeds.getimage(baseUrl, venuedetail['images'][0]['uri'], 480, 480, venuedetail['title'], '', '', 'img-detail', 0)}} 
						<div class="view-gallery">VIEW GALLERY</div>
				</div>
			</div>
		</div>

		{% if(venuedetail['reviews'][0] is defined) %}
		<div class="col-xs-12 no-padding">
			<h2 class="yfeeds">Critic Review</h2>
		</div><div class="clearfix"></div>
		<div class="critic_review_container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-4">
					<div class="authordata">
						<div class="author-image float-left">
							{{feeds.getimage(baseUrl, venuedetail['reviews'][0]['author']['images'][0]['uri'], 100, 100, venuedetail['reviews'][0]['author']['title'], venuedetail['reviews'][0]['author']['images'], 'width:100px; height:100px', 'img-detail icon-circle')}}
						</div>
						<div class="authordetail float-left">
							<h2 class="reviewtitle text-center"><span class="reviewd">Reviewed by</span><br>{{venuedetail['reviews'][0]['author']['title'] | lower | capitalize}}</h2>
							{% if(venuedetail['reviews'][0]['author']['twitter_url'] != '') %}
								<a href="https://twitter.com/{{venuedetail['reviews'][0]['author']['twitter_url']}}" class="twitter-follow-button" data-show-count="true"></a>
							{% endif %}
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6">
					<div class="rating-container text-center">
						<div class="rating-div float-left">
							<div class="total-rate">
								{{venuedetail['reviews'][0]['rwidth']}}
							</div>
							<div class="overall-rate">
								OUT OF 5
							</div>
						</div>
						<div class="progressbar float-left">
							{% for key, rating in venuedetail['reviews'][0]['ratings'] %}
							<div class="progres-bar">
								<div class="text-color float-left"><div class="rate-text float-left">{{key}}</div></div>
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
			
			<h2 class="contenttitle text-left">{{venuedetail['reviews'][0]['estIdData'][0]['text'] | stripslashes}}</h2>			
			<div class="detail">
				{{venuedetail['reviews'][0]['description']}}
			</div>

		</div>
		{% endif %}
		<div class="clearfix"></div><br/>
		<div class="share venue_share">
			<ul class="list-inline navbar-left">
				<li><a onclick="window.open('https://twitter.com/share?url={{baseUrl}}{{criticdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="twitter-icon"></div></a></li>
				<li><a onclick="window.open('http://www.facebook.com/sharer/sharer.php?u={{baseUrl}}{{criticdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="fb-icon"></div></a></li>
				<li><a onclick="window.open('https://plus.google.com/share?url={{baseUrl}}{{criticdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="google-icon"></div></a></li>
			</ul><div class="clearfix"></div>
		</div>

		<?php if(!empty($events)){ ?>
			<div class="upcoming_event">
				<div class="col-sm-12 col-md-12">
				<div class="row">
					<div class="col-xs-12 no-padding">
						<h2 class="yfeeds">Upcoming Events</h2>
					</div>
					<div class="row work-content">
						<div id="getupcomingevents">
							{{feeds.getfeeds(baseUrl, events, 0, cityshown, 'feed')}}
						</div><div class="clearfix"></div>
					</div>
				</div>
				</div>
			</div>
		<?php } ?>

		<?php if(!empty($pastevents)){ ?>
			<div class="upcoming_event">
				<div class="col-sm-12 col-md-12">
				<div class="row">
					<div class="col-xs-12 no-padding">
						<h2 class="yfeeds">Past Events</h2>
					</div>
					<div class="row work-content">
						<div id="getupcomingevents">
							<?php for($i=0; $i<10; $i++){ ?>
								{{feeds.getfeeds(baseUrl, pastevents, 0, cityshown, 'feed')}}
							<?php } ?>
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
function eventimages(){
	$.swipebox([
		{% for key, images in venuedetail['images'] %}
			{ href:'{{feeds.makeurl(baseUrl, images["uri"])}}', title:'{{venuedetail["title"]}}' },
		{% endfor  %}
	]);
}

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