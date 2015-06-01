<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>

<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="contentarea">
					<div class="author-image text-center">
						{{feeds.getimage(baseUrl, author['images'][0]['uri'], 100, 100, author['title'], author['images'], 'width:100px; height:100px', 'img-detail icon-circle')}}
					</div>
					<div class="clearfix"></div>
					<h2 class="contenttitle text-center">{{author['title']}}</h2>
					<?php if(isset($author['twitter_url']) && !empty($author['twitter_url'])){?>
					<div class="atwitter text-center">
						<a href="https://twitter.com/{{author['twitter_url']}}" class="twitter-follow-button" data-show-count="true"></a>
					</div>
					<?php }?>
					<hr class="small">

					{% if(author['description'] != '') %}
					<div class="detail text-center">
						<div class="text-center authorbio">{{author['description']}}</div>
					</div>
					<hr class="small">
					{% endif %}
				</div>
				
				<?php if(!empty($profilepost)){ ?>
					{% if(profilepost['meta']['match_count'] > 0) %}
						<h1 class="autorhead">{{profilepost['meta']['match_count']}} Posts from {{author['title']}}</h1>
						<div id="authorpost">
							<div class="work-content allfeeds">
								{{feeds.getfeedsforcoverimg(baseUrl, profilepost)}}
							</div>
						</div><div class="clearfix"></div>
						<div class="loadmore">
							<?php if($profilepost['meta']['match_count'] > ($limit)){ ?>
								<div class="btn btn-primary" onclick="view_feed_with_ajax('{{city}}','{{baseUrl}}/author/posts', '{{start}}', '{{limit}}', 'authorpost', '{{authorid}}', '', '', 'author')">Load More</div>
							<?php }?>
						</div>
					{% endif %}
				<?php } ?>
			</div>
		</div>
	</div>
</div>
