<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>

<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="contentarea">
					<div class="author-image text-center">
						<?php if(empty($author['profile']['image_url'])){ ?>
							<img src="{{baseUrl}}img/avatar-12.jpg" alt="{{author['profile']['full_name']}}" class="img-detail icon-circle">
						<?php }else{ ?>
							<img src="{{author['profile']['image_url']}}" alt="{{author['profile']['full_name']}}" class="img-detail icon-circle">
						<?php }?>
					</div>
					<div class="clearfix"></div>
					<h2 class="contenttitle text-center">{{author['profile']['full_name'] | lower | capitalize}}</h2>
					<div class="contentdetail text-center">
						By {{author['profile']['name']}}
					</div>
					<hr class="small">
					<div class="detail">
						{{author['profile']['description']}}
					</div>
				</div>
				<h1>{{profilepost['meta']['match_count']}} Posts from {{author['profile']['full_name'] | lower | capitalize}}</h1>
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
			</div>
		</div>
	</div>
</div>
