<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>

<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="contentarea">
					<ul id="owl-work-detail" class="owl-carousel work-detail">
					
					{% for key, images in contentdetail['images'] %}
						<li class="item">
							<a href="{{feeds.makeurl(baseUrl, images['uri'])}}" class="swipebox" title="{{contentdetail['title']}}">
								{{feeds.getimage(baseUrl, images['uri'], 880, 880, contentdetail['title'], '', '', 'img-detail', key+1)}} 
							</a>
						</li>
					{% endfor  %}
					</ul><div class="clearfix"></div>
					<h1 class="contenttitle text-center">{{contentdetail['title'] | stripslashes}}</h1>
					<div class="contentdetail text-center">
						{% if(author['title'] != '') %}
							By <a href="{{baseUrl}}{{author['url']}}">{{author['title'] | stripslashes}}</a>
						{% endif %}
					</div>
					<div class="sharesmall">
						<ul class="list-inline text-center">
							<li class="twitter"><a onclick="window.open('https://twitter.com/share?url={{baseUrl}}{{contentdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><i class="fa fa-twitter"></i> <span>Share</span></a></li>
							<li class="facebook"><a onclick="window.open('http://www.facebook.com/sharer/sharer.php?u={{baseUrl}}{{contentdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><i class="fa fa-facebook"></i>  <span>Share</span></a></li>
							<li class="google"><a onclick="window.open('https://plus.google.com/share?url={{baseUrl}}{{contentdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><i class="fa fa-google-plus"></i>  <span>Share</span></a></li>
						</ul><div class="clearfix"></div>
					</div>
					
					<hr class="small">
					<div class="detail">
						<?php //$description = str_replace(array('<p><strong>', '</strong></p>'), array('<h4>', '</h4>'), $contentdetail['description']); ?>
						{{contentdetail['description']}}
						
						{% if(contentdetail['tags'] | length > 0) %}
							<div class="work-content">
								<ul class="work-category-wrap tagsblack">
									<?php $populartags =$contentdetail['tags'];?>								
									{% for populartag in populartags %}
										<li class="filter" ><a href="{{baseUrl}}/{{currentCity}}/tag/{{elements.create_slug(populartag)}}">
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
								<li class="twitter"><a onclick="window.open('https://twitter.com/share?url={{baseUrl}}{{contentdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><i class="fa fa-twitter"></i>&nbsp;&nbsp;&nbsp; <span>Share</span></a></li>
								<li class="facebook"><a onclick="window.open('http://www.facebook.com/sharer/sharer.php?u={{baseUrl}}{{contentdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><i class="fa fa-facebook"></i>&nbsp;&nbsp;&nbsp; <span>Share</span></a></li>
								<li class="google"><a onclick="window.open('https://plus.google.com/share?url={{baseUrl}}{{contentdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><i class="fa fa-google-plus"></i>&nbsp;&nbsp;&nbsp; <span>Share</span></a></li>
							</ul><div class="clearfix"></div>
						</div>

						{% if(author['url'] is defined AND author['url'] != '') %}
						<div class="authordetailsection">
							<div class="col-sm-4 col-md-2 float-left author-image">
									<a href="{{baseUrl}}{{author['url']}}">
										{{feeds.getimage(baseUrl, author['images'][0]['uri'], '', '', author['title'], author['images'], 'width:100px; height:100px', 'img-detail icon-circle')}}
									</a>
							</div>
							
							
								<div class="col-xs-12 col-sm-8 col-md-10 author-detail">
										<h2><a href="{{baseUrl}}{{author['url']}}">{{author['title']}}</a></h2>
										<p>{{author['description']}}</p>
										
										{% if(author['twitter_url'] != '') %}
										<ul class="list-inline navbar-left authortwitter">
											<li class="no-padding">
												<a href="https://twitter.com/{{author['twitter_url']}}" class="twitter-follow-button" data-show-count="true">Follow @{{author['twitter_url']}}</a>
											</li>
										</ul><div class="clearfix"></div>
										{% endif %}
								</div>
							<div class="clearfix"></div>
						</div>
						{% endif %}
				</div>
			</div>
		</div>
	</div>
</div>