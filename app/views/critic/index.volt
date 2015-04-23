<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>

<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="contentarea">
					<div class="authordata text-center">
						<div class="author-image float-left">
							<?php if($author['images'][0]['uri']){ ?>
								<img src="{{author['images'][0]['uri']}}" alt="{{author['title']}}" class="img-detail icon-circle">
							<?php }else{ ?>
								<img src="{{baseUrl}}img/avatar-12.jpg" alt="{{author['title']}}" class="img-detail icon-circle">
							<?php }?>
						</div>
						<div class="authordetail float-left">
							<h2 class="reviewtitle text-center"><span class="reviewd">Reviewed by</span><br>{{author['title'] | lower | capitalize}}</h2>
							{% if(author['twitter_url'] != '') %}
								<div class="twitter"><a href="{{author['profile']['twitter_url']}}"><i class="fa fa-twitter"></i> @{{author['user_name']}}</a></div>
							{% endif %}
						</div>
					</div><div class="clearfix"></div>
					
					<h1 class="contenttitle text-center">{{criticdetail['title']}}</h1>
					<div class="review">
						<div class="rating">
							<div class="grayscale"></div>
							<div class="yellowscale" style="width:{{reviewwidth}}px"></div>
						</div>
						<div class="rmani"><span class="rwidth">{{rwidth}}</span> out of 5</div>
					</div>
					<hr class="small">
					<div class="clearfix"></div>
					<div class="detail">
						{{criticdetail['description']}}
						
						<?php if(!empty($criticdetail['tags'])){ ?>
						<h3 class="tags">Tags</h3>
						<hr>
						<div class="work-content">
							<ul class="work-category-wrap">
								<?php $populartags = explode(',', $criticdetail['tags']);?>								
								{% for populartag in populartags %}
									<li class="filter" ><a href="javascript:void(0)">
									{{populartag}}
									</a></li>
								{% endfor  %}
							</ul><div class="clearfix"></div>
						</div><div class="clearfix"></div>
						<?php } ?>
						
						<div class="share">
							<ul class="list-inline navbar-left">
								<li class="sharek">SHARE</li>
								<li><a href="{{author['twitter_url']}}"><i class="fa fa-twitter-square"></i> Share on twitter</a></li>
								<li><a href="{{author['facebook_url']}}"><i class="fa fa-facebook-square"></i> Share on facebook</a></li>
								<li><a href="{{author['google_url']}}"><i class="fa fa-google-plus-square"></i> Share on google+</a></li>
							</ul><div class="clearfix"></div>
						</div>
						
						<div class="authordetailsection">
							<div class="author-image float-left">
								<?php if($author['images'][0]['uri']){ ?>
									<img src="{{author['images'][0]['uri']}}" alt="{{author['title']}}" class="img-detail icon-circle">
								<?php }else{ ?>
									<img src="{{baseUrl}}img/avatar-12.jpg" alt="{{author['title']}}" class="img-detail icon-circle">
								<?php }?>
							</div>
							<div class="author-detail float-left">
								<h2>{{author['title']}}</h2>
								<p>{{author['description']}}</p>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>