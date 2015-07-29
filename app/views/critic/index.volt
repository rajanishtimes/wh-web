<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>

<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="contentarea">
					<!--<div class="authordata text-center">
						<div class="author-image float-left">
							<a href="{{baseUrl}}{{author['url']}}">
								{{feeds.getimage(baseUrl, author['images'][0]['uri'], 100, 100, author['title'], author['images'], 'width:100px; height:100px', 'img-detail icon-circle')}}
							</a>
						</div>
						<div class="authordetail float-left">
							<h2 class="reviewtitle text-center"><span class="reviewd">Reviewed by</span><br><a href="{{baseUrl}}{{author['url']}}">{{author['title'] | lower | capitalize}}</a></h2>
							{% if(author['twitter_url'] != '') %}
								<a href="https://twitter.com/{{author['twitter_url']}}" class="twitter-follow-button" data-show-count="true"></a>

								<!--<div class="twitter"><a href="http://www.twitter.com/{{author['twitter_url']}}" target="_blank"><i class="fa fa-twitter"></i> {{author['user_name']}}</a></div>--
							{% endif %}
						</div>
					</div><div class="clearfix"></div>-->
					
					<h1 class="contenttitle text-center">{{criticdetail['title'] | stripslashes}}</h1>
					<div class="contentdetail text-center">
						{% if(author['title'] != '') %}
							<span style="color:gray">Reviewed by</span> <a href="{{baseUrl}}{{author['url']}}">{{author['title'] | lower | capitalize}}</a>
							
							{% endif %}
					</div>
					<div class="sharesmall">
						<ul class="list-inline text-center">
							<li><a onclick="window.open('https://twitter.com/share?url={{baseUrl}}{{criticdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="twitter-icon"><i class="fa fa-twitter"></i>&nbsp;<span>Share</span></div></a></li>
							<li><a onclick="window.open('http://www.facebook.com/sharer/sharer.php?u={{baseUrl}}{{criticdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="fb-icon"><i class="fa fa-facebook"></i>&nbsp;<span>Share</span></div></a></li>
							<li><a onclick="window.open('https://plus.google.com/share?url={{baseUrl}}{{criticdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="google-icon"><i class="fa fa-google-plus"></i>&nbsp;<span>Share</span></div></a></li>
						</ul><div class="clearfix"></div>
					</div>
					<!--<div class="review">
						<div class="rating">
							<div class="grayscale"></div>
							<div class="yellowscale" style="width:{{reviewwidth}}px"></div>
						</div>
						<div class="rmani"><span class="rwidth">{{rwidth}}</span> out of 5</div>
					</div>-->

					<div class="clearfix"></div>
					<hr class="small">
					<div class="clearfix"></div>

					<div class="detail">
						<div class="rating-container text-center">
							<!--<div class="rating-div float-left">
								<div class="total-rate">
									{{rwidth}}
								</div>
								<div class="overall-rate">
									OUT OF 5
								</div>
							</div>-->
							<div class="progressbar float-left">
								{% for key, rating in ratings %}
								<div class="progres-bar">
									<div class="text-color float-left"><div class="rate-text float-left">{{rating['title']}}</div></div>
									<div class="progress-container">
										<div class="single-color"></div>
										<div class="multi-color" style="background-color:{{rating['background_color']}}; border-color:{{rating['border_color']}}; width:{{rating['width']}}%"></div>
									</div>
									<div class="text-color float-right"><div class="overall-span float-right">{{rating['rating']}}/5</div></div>
								</div>
								{% endfor %}
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="clearfix"></div>
					<br><br>
					<div class="detail">
						{{criticdetail['description']}}
					</div>
					<div class="share">
						<ul class="list-inline navbar-left">
							<li><a onclick="window.open('https://twitter.com/share?url={{baseUrl}}{{criticdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="twitter-icon"><i class="fa fa-twitter"></i>&nbsp;<span>Share</span></div></a></li>
							<li><a onclick="window.open('http://www.facebook.com/sharer/sharer.php?u={{baseUrl}}{{criticdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="fb-icon"><i class="fa fa-facebook"></i>&nbsp;<span>Share</span></div></a></li>
							<li><a onclick="window.open('https://plus.google.com/share?url={{baseUrl}}{{criticdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="google-icon"><i class="fa fa-google-plus"></i>&nbsp;<span>Share</span></div></a></li>
						</ul><div class="clearfix"></div>
					</div>

					<div class="share sharewithborder" style="margin:10px 0">
						{% if(criticdetail['tags'] | length > 0) %}
							<p class="tags">Tags</p>
							<div class="work-content">
								<ul class="work-category-wrap tagsblack">
									<?php $populartags =$criticdetail['tags'];?>								
									{% for populartag in populartags %}
										<li class="filter" ><a href="{{baseUrl}}/{{currentCity}}/tag/{{elements.create_slug(populartag)}}">
										{{populartag}}
										</a></li>
									{% endfor  %}
								</ul><div class="clearfix"></div>
							</div>
						{% endif %}
					</div><div class="clearfix"></div>

					<div class="authordetailsection">
						<div class="col-sm-4 col-md-2 float-left author-image">
								<a href="{{baseUrl}}{{author['url']}}">
									{{feeds.getimage(baseUrl, author['images'][0]['uri'], 100, 100, author['title'], author['images'], 'width:100px; height:100px; border-radius: 50%; margin: 0px auto;', 'img-detail icon-circle')}}
								</a>
						</div>
						
						
							<div class="col-xs-12 col-sm-8 col-md-10 author-detail">
									<h2><a href="{{baseUrl}}{{author['url']}}">{{author['title']}}</a></h2>
									<p>{{author['description']}}</p>
									
									{% if(author['twitter_url'] != '') %}
									<ul class="list-inline navbar-left authortwitter">
										<li class="no-padding">
											<a href="https://twitter.com/{{author['twitter_url']}}" class="twitter-follow-button" data-show-count="true"></a>
										</li>
									</ul><div class="clearfix"></div>
									{% endif %}
							</div>
						<div class="clearfix"></div>
					</div>


				
					
				</div>
			</div>
		</div>
	</div>
</div>