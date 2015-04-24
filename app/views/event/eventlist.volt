<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				{% if(allfeedslist | length > 0) %}
					<div class="col-sm-6 col-md-6 col-xs-12 no-padding">
						<h2 class="yfeeds">Your Feeds</h2>
					</div><div class="clearfix"></div>
					<div class="work-content allfeeds">
						<div id="getallfeeds">					
							{{feeds.getfeeds(baseUrl, allfeedslist, start)}}
						</div><div class="clearfix"></div>
						<div class="loadmore">
							<?php if($allfeedslist['meta']['match_count'] > ($limit)){ ?>
								<div class="btn btn-primary" onclick="view_feed_with_ajax('{{baseUrl}}search/index', '{{start}}', '{{limit}}', 'getallfeeds', '', '', 'all')">Load More</div>
							<?php }?>
						</div>
					</div>
				{% endif %}
			</div>
		</div>
	</div>
</div>