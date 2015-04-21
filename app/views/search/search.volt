<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<h1>{{allfeedslist['meta']['match_count']}} result(s) found from &#8220;{{searchkeyword}}&#8221;</h1>
				<div class="work-content allfeeds">
					<div id="getallfeedssearch">					
						{{feeds.getfeeds(baseUrl, allfeedslist)}}
					</div><div class="clearfix"></div>
					<div class="loadmore">
						<?php if($allfeedslist['meta']['match_count'] > ($limit)){ ?>
							<div class="btn btn-primary" onclick="view_feed_with_ajax('{{baseUrl}}search/index', '{{start}}', '{{limit}}', 'getallfeedssearch', '', '', 'all')">Load More</div>
						<?php }?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>