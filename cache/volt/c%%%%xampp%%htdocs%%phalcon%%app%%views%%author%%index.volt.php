<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>

<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="contentarea">
					<div class="author-image text-center">
						<?php if(empty($author['profile']['image_url'])){ ?>
							<img src="<?php echo $baseUrl; ?>img/avatar-12.jpg" alt="<?php echo $author['profile']['full_name']; ?>" class="img-detail icon-circle">
						<?php }else{ ?>
							<img src="<?php echo $author['profile']['image_url']; ?>" alt="<?php echo $author['profile']['full_name']; ?>" class="img-detail icon-circle">
						<?php }?>
					</div>
					<div class="clearfix"></div>
					<h2 class="contenttitle text-center"><?php echo ucwords(Phalcon\Text::lower($author['profile']['full_name'])); ?></h2>
					<div class="contentdetail text-center">
						By <?php echo $author['profile']['name']; ?>
					</div>
					<hr class="small">
					<div class="detail">
						<?php echo $author['profile']['description']; ?>
					</div>
				</div>
				<h1><?php echo $profilepost['meta']['match_count']; ?> Posts from <?php echo ucwords(Phalcon\Text::lower($author['profile']['full_name'])); ?></h1>
				<div id="authorpost">
					<div class="work-content allfeeds">
						<?php foreach ($profilepost['results'] as $feed) { ?>
						<div class="col-sm-4 col-md-3 col-xs-6">
							<div class="work-item">
								<a href="<?php echo $baseUrl; ?><?php echo $city; ?>/<?php echo $feed['slug']; ?>"><img src="<?php echo $feed['cover_image']; ?>" alt="<?php echo $feed['title']; ?>"></a>
								<div class="the-box no-margin">
									<div class="feed-title"><a href="<?php echo $baseUrl; ?><?php echo $city; ?>/<?php echo $feed['slug']; ?>"><?php echo $feed['title']; ?></a></div>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div><div class="clearfix"></div>
				<div class="loadmore">
					<?php if($profilepost['meta']['match_count'] > ($limit)){ ?>
						<div class="btn btn-primary" onclick="view_feed_with_ajax('<?php echo $baseUrl; ?>author/posts', '<?php echo $start; ?>', '<?php echo $limit; ?>', 'authorpost', '<?php echo $authorid; ?>', '', '')">Load More</div>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</div>
