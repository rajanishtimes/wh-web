<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="contentarea">
					<ul id="owl-work-detail" class="owl-carousel work-detail">
					<?php foreach ($eventdetail['images'] as $images) { ?>
						<li class="item">
							<a href="<?php echo $images['uri']; ?>" class="swipebox" title="<?php echo $eventdetail['title']; ?>">
								<img src="<?php echo $images['uri']; ?>" alt="<?php echo $eventdetail['title']; ?>" class="img-detail">
							</a>
						</li>
					<?php } ?>
					</ul><div class="clearfix"></div>
					<h2 class="contenttitle text-center"><?php echo $eventdetail['title']; ?></h2>
					<div class="eventdetail">
						<div class="time"><?php echo $eventdetail['time']['short']; ?>, <?php echo $eventdetail['time']['long']; ?></div>
						<div class="venue"><?php echo $eventdetail['venue']['formatted_address']; ?></div>
					</div>
					<hr class="small">
					<div class="detail">
						<?php echo $eventdetail['description']; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>