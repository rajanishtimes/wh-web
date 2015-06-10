<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 no-padding">
				<div class="venuemain-container">
					<div class="col-sm-12 col-md-8 no-padding venueleft">

						<div class="view_overlay">
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
						<div id="map_canvas" style="width: 100%; height: 395px;"></div>
					</div>
					<div class="col-sm-12 col-md-4 no-padding venueright">
						<div class="view_gallery">
								{{feeds.getimage(baseUrl, venuedetail['images'][0]['uri'], 250, 520, venuedetail['title'], '', '', 'img-detail', 0)}} 
						</div>
					</div>
				</div>
				
				<br><br>
				<div class="upcoming_event">
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
	</div>
</div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
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