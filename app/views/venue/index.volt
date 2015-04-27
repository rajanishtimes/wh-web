<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<h2 class="venuetitle">{{venuedetail['title']}}</h2>
				<div class="venuedetail">
					<div class="time">{{venuedetail['formatted_address']}}</div>
					<div class="phone"><?php echo implode(',', $venuedetail['phonedata']); if($venuedetail['phonedata']){echo ",";}?> <?php echo implode(',', $venuedetail['mobiledata']); ?></div>
					<div class="landmark">{{venuedetail['landmark']}}</div>
					<div class="website"><a href="{{venuedetail['website']}}" target="_blank"><?php echo str_replace('http://','',$venuedetail['website'])?></a></div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				<div id="map_canvas" style="width: 100%; height: 250px;"></div>
			</div>
			<hr>
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