<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<h1>{{allfeedslist['meta']['match_count']}} result(s) found from &#8220;{{searchkeyword}}&#8221;</h1>
				<div class="work-content allfeeds">
					<div id="getallfeedssearch">					
						{% for feed in allfeedslist['results'] %}
						<?php //echo "<pre>"; print_r($feed); ?>
						<div class="col-sm-4 col-md-3 col-xs-6">
							<div class="work-item">
								<a href="{{baseUrl}}{{city}}/{{feed['slug']}}">
									{% if(feed['image']['uri'] is empty) %}
										{{elements.imgnotfound(baseUrl, feed['title'])}}
									{% else %}
										<img src="{{feed['image']['uri']}}" alt="{{feed['title']}}">
									{% endif %}
								</a>
								<div class="the-box no-margin">
									<div class="feed-title"><a href="{{baseUrl}}{{city}}/{{feed['slug']}}">{{feed['title']}}</a></div>
									<p class="feed-short-desc">{{feed['description']}}</p>
								</div>
							</div>
						</div>
						{% endfor  %}
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