<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12 no-padding">
				{% if(tagsfeeds | length > 0) %}
					<h1 class="searchheading">{{tagsfeeds['meta']['match_count']}} result(s) found from &#8220;<strong><?php echo $tags; ?></strong>&#8221;</h1>
					<div class="row resize work-content allfeeds feedtags">
						<div id="getallfeedssearch">					
							{{feeds.getfeeds(baseUrl, tagsfeeds, start, cityshown, 'tags')}}
						</div><div class="clearfix"></div>
						<div class="loadmore">
							<?php if($tagsfeeds['meta']['match_count'] > ($limit)){ ?>
								<div class="btn btn-primary" onclick="view_feed_with_ajax('{{currentCity}}', '{{baseUrl}}/search/index', '{{start}}', '{{limit}}', 'getallfeedssearch', '{{elements.create_slug(tags)}}', 'tags', 'all', 'tags')">Load More</div>
							<?php }?>
						</div>
					</div>
				{% else %}
					<h1>No Result Found From &#8220;{{tags}}&#8221;</h1><div style="height:250px"></div>
				{% endif %}
			</div>
		</div>
	</div>
</div>