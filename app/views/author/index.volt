<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>

<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="contentarea">
					<div class="author-image text-center">
						{{feeds.getimage(baseUrl, author['images'][0]['uri'], '', '', author['title'], author['images'], 'width:100px; height:100px', 'img-detail icon-circle')}}
					</div>
					<div class="clearfix"></div>
					<h2 class="contenttitle text-center">{{author['title'] | lower | capitalize}}</h2>
					<?php if(isset($author['twitter_url']) && !empty($author['twitter_url'])){?>
					<div class="atwitter text-center">
						<a href="http://twitter.com/{{author['twitter_url']}}" target="_blank">
							<i class="fa fa-twitter"></i>@{{author['user_name']}}
						</a>
					</div>
					<?php }?>
					<hr class="small">
					<div class="detail text-center">
						<div class="text-center authorbio">{{author['description']}}</div>
					</div>
				</div>
				
				{% if(profilepost['meta']['match_count'] > 0) %}
					<h1>{{profilepost['meta']['match_count']}} Posts from {{author['title'] | lower | capitalize}}</h1>
					<div id="authorpost">
						<div class="work-content allfeeds">
							{{feeds.getfeedsforcoverimg(baseUrl, profilepost)}}
						</div>
					</div><div class="clearfix"></div>
					<div class="loadmore">
						<?php if($profilepost['meta']['match_count'] > ($limit)){ ?>
							<div class="btn btn-primary" onclick="view_feed_with_ajax('{{city}}','{{baseUrl}}/author/posts', '{{start}}', '{{limit}}', 'authorpost', '{{authorid}}', '', '')">Load More</div>
						<?php }?>
					</div>
				{% endif %}
			</div>
		</div>
	</div>
</div>
