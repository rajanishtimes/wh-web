<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>
<div class="section">
	<div class="container">
		
		<?php if(isset($tagsfeeds['results']['tags']) && !empty($tagsfeeds['results']['tags'])){ ?>
			<div class="row margin-bottom-30 margin-top-20">
				<div class="col-sm-12 col-md-12 no-padding">
					<div class="col-sm-2 col-md-2 text-center">
						{{feeds.getimage(baseUrl, tagsfeeds['results']['tags']['uri'], 100, 100, tags, '', '', 'img-circle', 1)}} 
					</div>
					<div class="col-sm-10 col-md-10 tag_desc">
						{{tagsfeeds['results']['tags']['description']}}
					</div>		
				</div>
			</div>
			<hr class="row">
		<?php } ?>

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
								<div class="btn btn-primary" onclick="view_feed_with_ajax('{{currentCity}}', '{{baseUrl}}/search/index', '{{start}}', '{{limit}}', 'getallfeedssearch', '{{elements.create_slug(tags)}}', 'tags', 'all', 'tags', '{{spstart}}', '{{splimit}}')">Load More</div>
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