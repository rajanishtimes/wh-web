<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<h2 class="venuetitle"><?php echo $venuedetail['title']; ?></h2>
				<div class="venuedetail">
					<div class="time"><i class="fa fa-map-marker"></i><?php echo $venuedetail['formatted_address']; ?></div>
					<div class="phone"><?php print_r($venuedetail['phonedata']); ?>, <?php print_r($venuedetail['mobiledata']); ?></div>
					<div class="landmark"><?php echo $venuedetail['landmark']; ?></div>
					<div class="website"><a href="<?php echo $venuedetail['website']; ?>" target="_blank"><?php echo $venuedetail['website']; ?></a></div>
				</div>
			</div>
			<div class="col-sm-12 col-md-6">
				
			</div>
			<hr>
		</div>
	</div>
</div>