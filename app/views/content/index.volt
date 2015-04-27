<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>

<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="contentarea">
					<ul id="owl-work-detail" class="owl-carousel work-detail">
					{% for images in contentdetail['images'] %}
						<li class="item">
							<a href="{{images['uri']}}" class="swipebox" title="{{contentdetail['title']}}">
								{{feeds.getimage(baseUrl, images['uri'], '', '', contentdetail['title'], '', '', 'img-detail')}}
							</a>
						</li>
					{% endfor  %}
					</ul><div class="clearfix"></div>
					<h2 class="contenttitle text-center">{{contentdetail['title']}}</h2>
					<div class="contentdetail text-center">
						By <a href="{{baseUrl}}{{author['url']}}">{{author['title']}}</a>
					</div>
					<hr class="small">
					<div class="detail">
						{{contentdetail['description']}}
						
						{% if(contentdetail['tags'] | length > 0) %}
							<p class="tags">Tags</p>
							<div class="work-content">
								<ul class="work-category-wrap">
									<?php $populartags =$contentdetail['tags'];?>								
									{% for populartag in populartags %}
										<li class="filter" ><a href="{{baseUrl}}tag/{{populartag}}">
										{{populartag}}
										</a></li>
									{% endfor  %}
								</ul><div class="clearfix"></div>
							</div><div class="clearfix"></div>
						{% endif %}
							
					</div>
						<div class="share">
							<ul class="list-inline navbar-left">
								<li class="sharek">SHARE</li>
								<li><a target="_blank" onclick="window.open('https://twitter.com/share?url={{contentdetail['share_url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><i class="fa fa-twitter-square"></i> <span>Share on twitter </span></a></li>
								<li><a target="_blank" onclick="window.open('http://www.facebook.com/sharer/sharer.php?u={{contentdetail['share_url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><i class="fa fa-facebook-square"></i>  <span>Share on facebook </span></a></li>
								<li><a target="_blank" onclick="window.open('https://plus.google.com/share?url={{contentdetail['share_url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><i class="fa fa-google-plus-square"></i>  <span>Share on google+ </span></a></li>
							</ul><div class="clearfix"></div>
						</div>
						
						<div class="authordetailsection">
							<div class="col-sm-4 col-md-2 float-left author-image">
									<a href="{{baseUrl}}{{author['url']}}">
										{{feeds.getimage(baseUrl, author['images'][0]['uri'], '', '', author['title'], author['images'], 'width:100px; height:100px', 'img-detail icon-circle')}}
									</a>
							</div>
							<div class="col-xs-12 col-sm-8 col-md-10 author-detail">
									<h2><a href="{{baseUrl}}{{author['url']}}">{{author['title']}}</a></h2>
									<p>{{author['description']}}</p>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>