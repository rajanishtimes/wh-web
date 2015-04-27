<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>

<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="contentarea">
					<div class="authordata text-center">
						<div class="author-image float-left">
							{{feeds.getimage(baseUrl, author['images'][0]['uri'], '', '', author['title'], author['images'], 'width:100px; height:100px', 'img-detail icon-circle')}}
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
						
						{% if(criticdetail['tags'] | length > 0) %}
							<p class="tags">Tags</p>
							<div class="work-content">
								<ul class="work-category-wrap">
									<?php $populartags =$criticdetail['tags'];?>								
									{% for populartag in populartags %}
										<li class="filter" ><a href="{{baseUrl}}tag/{{populartag}}">
										{{populartag}}
										</a></li>
									{% endfor  %}
								</ul><div class="clearfix"></div>
							</div><div class="clearfix"></div>
						{% endif %}
						
						<div class="share">
							<ul class="list-inline navbar-left">
								<li class="sharek">SHARE</li>
								<li><a target="_blank" onclick="window.open('https://twitter.com/share?url={{criticdetail['share_url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><i class="fa fa-twitter-square"></i>  <span>Share on twitter</span></a></li>
								<li><a target="_blank" onclick="window.open('http://www.facebook.com/sharer/sharer.php?u={{criticdetail['share_url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><i class="fa fa-facebook-square"></i> <span> Share on facebook</span></a></li>
								<li><a target="_blank" onclick="window.open('https://plus.google.com/share?url={{criticdetail['share_url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><i class="fa fa-google-plus-square"></i>  <span>Share on google+ </span></a></li>
							</ul><div class="clearfix"></div>
						</div>
						
						<div class="authordetailsection">
							<div class="author-image float-left">
								<a href="{{baseUrl}}{{author['url']}}">
									{{feeds.getimage(baseUrl, author['images'][0]['uri'], '', '', author['title'], author['images'], 'width:100px; height:100px', 'img-detail icon-circle')}}
								</a>
							</div>
							<div class="author-detail float-left">
								<h2><a href="{{baseUrl}}{{author['url']}}">{{author['title']}}</a></h2>
								<p>{{author['description']}}</p>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>