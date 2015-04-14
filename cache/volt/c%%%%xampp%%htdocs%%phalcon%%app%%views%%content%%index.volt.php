<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>

<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="contentarea">
					<ul id="owl-work-detail" class="owl-carousel work-detail">
					<?php foreach ($contentdetail['images'] as $images) { ?>
						<li class="item">
							<a href="<?php echo $images['uri']; ?>" class="swipebox" title="<?php echo $contentdetail['title']; ?>">
								<img src="<?php echo $images['uri']; ?>" alt="<?php echo $contentdetail['title']; ?>" class="img-detail">
							</a>
						</li>
					<?php } ?>
					</ul><div class="clearfix"></div>
					<h2 class="contenttitle text-center"><?php echo $contentdetail['title']; ?></h2>
					<div class="contentdetail text-center">
						By <a href="<?php echo $baseUrl; ?>author/<?php echo $contentdetail['author']['slug']; ?>"><?php echo $contentdetail['author']['name']; ?></a>
					</div>
					<hr class="small">
					<div class="detail">
						<?php echo $contentdetail['description']; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>