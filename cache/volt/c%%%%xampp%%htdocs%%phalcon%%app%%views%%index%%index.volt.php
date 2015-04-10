<div class="section">
	<div class="container">
		<div class="row">
			<h1>Hey! Top Things to do today</h1>
			<div class="work-content">
				<?php foreach ($topfeeds['results'] as $topfeed) { ?>
					<div class="col-sm-6 col-md-4 col-xs-6">
						<a href="<?php echo $baseUrl; ?><?php echo $city; ?>/<?php echo $topfeed['slug']; ?>">
							<div class="work-item">
								<div class="the-box full no-border transparent no-margin make-up">
									<p class="feed-name"><?php echo $topfeed['title']; ?></p>
								</div>
								<img src="<?php echo $topfeed['image']['uri']; ?>" alt="<?php echo $topfeed['title']; ?>">
							</div>
						</a>
					</div>
				<?php } ?>
			</div>
			<div class="clearfix"></div>
			<hr>
			<input id="tags" type="hidden" value="">
			<input id="bydatefeed" type="hidden" value="">
			
			<div class="work-content">						
				<h2 class="heading">Popular Tips</h2>
				<ul id="populartag" class="work-category-wrap">
					<?php foreach ($populartags['popular_tags'] as $populartag) { ?>
					<li class="filter" ><a href="javascript:void(0)">
					<?php echo ucwords($populartag); ?>
					</a></li>
					<?php } ?>
				</ul><div class="clearfix"></div>
			</div><div class="clearfix"></div><hr>
			<div class="col-sm-6 col-md-6 col-xs-12 no-padding">
				<h2>Your Feeds</h2>
			</div>
			<div class="col-sm-6 col-md-6 col-xs-12">
				<ul id="bydate" class="filter_type text-right">
					<li><a href="javascript:void(0)">TODAY</a></li>
					<li><a href="javascript:void(0)">TOMMORROW</a></li>
					<li><a href="javascript:void(0)">THIS WEEKEND</a></li>
					<li class="active"><a href="javascript:void(0)">ALL</a></li>
				</ul>
			</div><div class="clearfix"></div>
			
			
			<div class="work-content allfeeds">
				<div id="getallfeeds"></div><div class="clearfix"></div><div class="loadmore"></div>
				
				<!--<?php foreach ($allfeedslist['results'] as $feed) { ?>
				<?php //echo "<pre>"; print_r($feed); ?>
				<div class="col-sm-4 col-md-3 col-xs-6">
					<div class="work-item">
						<a href="<?php echo $baseUrl; ?><?php echo $city; ?>/<?php echo $topfeed['slug']; ?>"><img src="<?php echo $feed['image']['uri']; ?>" alt="<?php echo $feed['title']; ?>"></a>
						<div class="the-box no-margin">
							<div class="feed-title"><a href="<?php echo $baseUrl; ?><?php echo $city; ?>/<?php echo $topfeed['slug']; ?>"><?php echo $feed['title']; ?></a></div>
							<p class="feed-short-desc"><?php echo $feed['description']; ?></p>
						</div>
					</div>
				</div>
				<?php } ?>-->

			</div>
			
		</div>
	</div>
</div>