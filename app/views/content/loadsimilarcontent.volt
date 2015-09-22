<?php if(!empty($similarcontent['results'])){ ?>
<div class="section grayed">
	<div class="container">
		<div class="row">
			<div class="clearfix"></div>
			<h3 class="heading">You may also like</h3>
			<div class="row work-content allfeeds">
				<div id="similar_content_slider" class="similar-work">
					{% for key, scontent in similarcontent['results'] %}
					<div class="col-md-12">
						<div class="work-item feeds-data">
							<a href="{{baseUrl}}{{scontent['url']}}">
								<div class="hover-container">
									<div class="hover-wrap">
										<i class="glyphicon glyphicon-plus bino"></i>
									</div>
									{{feeds.getimage(baseUrl, scontent['image']['uri'], 479, 479, scontent['title'], scontent['image'], '', '', key)}}
								</div>
							</a>
							<a href="{{baseUrl}}{{scontent['url']}}">
								<div class="the-box no-margin no-border">
									<div class="boundarea">
										<div title="{{scontent['title']}}" class="feed-title">{{scontent['title']}}</div>
										<div class="feed-short-desc">{{scontent['description']}}</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				{% endfor  %}
			</div></div>
		</div>
	</div>
</div>
<script type="text/javascript">
$("#similar_content_slider").owlCarousel({
		items : 4,
		navigation : false,
		slideSpeed : 400,
		paginationSpeed : 400,
		autoPlay : false,
		stopOnHover : true,
		singleItem: false,
	});
</script>
<?php } ?>