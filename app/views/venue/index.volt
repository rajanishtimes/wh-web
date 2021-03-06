<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<h2 class="venuetitle">{{venuedetail['title']}}</h2>
				<div class="venuedetail">
					{% if(venuedetail['formatted_address'] != '') %}
						<div class="time"><div class="timeimg"></div>{{venuedetail['formatted_address']}}</div>
					{% endif %}
					
					<?php
						$venuedetail['mobiledata'] = array_filter($venuedetail['mobiledata']);
						$venuedetail['phonedata'] = array_filter($venuedetail['phonedata']);
					?>
					{% if(venuedetail['mobiledata'] | length > 0 OR venuedetail['phonedata'] | length >  0) %}
						<div class="phone"><div class="phoneimg"></div>
							<?php 
								echo implode(', ', $venuedetail['phonedata']);
								if(!empty($venuedetail['mobiledata']) && !empty($venuedetail['phonedata'])){
									echo ",";
								}
							?>
							<?php echo implode(', ', $venuedetail['mobiledata']);?>
						</div>
					{% endif %}
					
					{% if(venuedetail['landmark'] != '') %}
						<div class="landmark"><div class="landmarkimg"></div>{{venuedetail['landmark']}}</div>
					{% endif %}
					
					{% if(venuedetail['website'] != '') %}
						<div class="website"><div class="websiteimg"></div><a href="{{venuedetail['website']}}" target="_blank"><?php echo str_replace('http://','',$venuedetail['website'])?></a></div>
					{% endif %}
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div id="map_canvas" style="width: 100%; height: 250px;"></div>
			</div><div class="clearfix"></div><div style="height:20px"></div>
			<hr><div style="height:200px"></div>
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