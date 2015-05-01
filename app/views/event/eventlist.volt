<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				{% if(allfeedslist | length > 0) %}
					<div class="col-sm-6 col-md-6 col-xs-12 no-padding">
						<h2 class="yfeeds">Events in {{currentCity | lower | capitalize}}</h2>
					</div><div class="clearfix"></div>
					<div class="work-content allfeeds">
						<div id="getallfeeds">					
							{{feeds.getfeeds(baseUrl, allfeedslist, start)}}
						</div><div class="clearfix"></div>
						<div class="loadmore">
							<?php if($allfeedslist['meta']['match_count'] > ($limit)){ ?>
								<div class="btn btn-primary" onclick="view_feed_with_ajax('{{city}}','{{baseUrl}}/search/index', '{{start}}', '{{limit}}', 'getallfeeds', '', '', 'all')">Load More</div>
							<?php }?>
						</div>
					</div>
				{% else %}
					<div class="notfound">
						<div class="col-sm-3 col-md-3 col-xs-12 text-center">
							<img src="{{baseUrl}}/img/no-feed.png">
						</div>
						<div class="col-sm-9 col-md-9 col-xs-12">
							<h1>Oops!</h1>
							Unfortunately, We could not find any results matching your search. We tried really hard. We looked all over the place and frankly, We just couldn't find anything good.
							<br><br><a href="{{baseUrl}}/{{city}}">GO BACK HOME</a>
							<div style="height:100px"></div>
						</div>
					</div>
				{% endif %}
			</div>
		</div>
	</div>
</div>