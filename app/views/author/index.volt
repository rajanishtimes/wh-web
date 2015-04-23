<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>

<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="contentarea">
					<div class="author-image text-center">
						<?php if($author['images'][0]['uri']){ ?>
							<img src="{{author['images'][0]['uri']}}" alt="{{author['title']}}" class="img-detail icon-circle">
						<?php }else{ ?>
							<img src="{{baseUrl}}img/avatar-12.jpg" alt="{{author['title']}}" class="img-detail icon-circle">
						<?php }?>
					</div>
					<div class="clearfix"></div>
					<h2 class="contenttitle text-center">{{author['title'] | lower | capitalize}}</h2>
					<div class="contentdetail text-center">
						By {{author['user_name']}}
					</div>
					<hr class="small">
					<div class="detail">
						{{author['description']}}
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
							<div class="btn btn-primary" onclick="view_feed_with_ajax('{{baseUrl}}author/posts', '{{start}}', '{{limit}}', 'authorpost', '{{authorid}}', '', '')">Load More</div>
						<?php }?>
					</div>
				{% endif %}
			</div>
		</div>
	</div>
</div>
