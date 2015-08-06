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
								{{feeds.getimage(baseUrl, images['uri'], 880, 520, contentdetail['title'], '', '', 'img-detail', key+1, 'banner')}} 
							</a>
						</li>
					{% endfor  %}
					</ul><div class="clearfix"></div>
					<h1 class="contenttitle text-center">{{contentdetail['title'] | stripslashes}}</h1>
					<div class="contentdetail text-center">
						{% if(author['title'] != '') %}
							By <a href="{{baseUrl}}{{author['url']}}" data-ga-cat="Author Link Click on Content Detail - {{cityshown}}" data-ga-action="{{author['title'] | stripslashes | trim}}" data-ga-label="author">{{author['title'] | stripslashes}}</a>
						{% endif %}
					</div>

					<?php if(!empty($contentdetail['published_date'])){ ?>
						<div class="text-center published" data-time="<?php echo date('j-M-Y h:i:s a', strtotime($contentdetail['published_date'])); ?>">Published {{elements.friendlyTime(contentdetail['published_date'])}}</div>
					<?php } ?>

					<div class="sharesmall">
						<ul class="list-inline text-center">
							<li class="twitter"><a onclick="window.open('https://twitter.com/share?url={{baseUrl}}{{contentdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#">
								<div class="twitter-icon"><i class="fa fa-twitter"></i>&nbsp;<span>Share</span></div>
							</a></li>
							<li class="facebook"><a onclick="window.open('http://www.facebook.com/sharer/sharer.php?u={{baseUrl}}{{contentdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="fb-icon"><i class="fa fa-facebook"></i>&nbsp;<span>Share</span></div></a></li>
							<li class="google"><a onclick="window.open('https://plus.google.com/share?url={{baseUrl}}{{contentdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="google-icon"><i class="fa fa-google-plus"></i>&nbsp;<span>Share</span></div></a></li>
						</ul><div class="clearfix"></div>
					</div>
					<br>
					<?php if(!empty($contentdetail['summary'])){ ?>
						<div class="summary detail text-center"><p>{{contentdetail['summary']}}</p></div>
					<?php } ?>
					<hr class="small">

						<div class="detail">
							<div class="wishlist-container">
								<div class="wishlist-wrapper add-wishlist">
									<div class="wishlist-text float-left">
										Want to add Kebab Express into your Wishlist?
									</div>
									<div class="btn btn-primary float-right" onclick="addtowishlistwithlogin()">ADD</div>
									<div class="btn btn-primary float-right">&#10003;</div>

									<div class="clearfix"></div>
								</div>
							</div>
							<?php //$description = str_replace(array('<p><strong>', '</strong></p>'), array('<h4>', '</h4>'), $contentdetail['description']); ?>
							{{contentdetail['description']}}
						</div>

						<div class="detail">
							<script class="lockerdome-js-lite" src="//cdn2.lockerdome.com/_js/widget_interest_1_0.js" data-owner="7850612108835329" data-style="text" data-width="full-width" data-size="custom-large" data-size_specifics="40" data-box="box-on" data-follow_up="7891395776104219" data-follow_up_specifics="2"></script>
						</div>
											

						<div class="share">
							<ul class="list-inline navbar-left">
								<li class="twitter"><a onclick="window.open('https://twitter.com/share?url={{baseUrl}}{{contentdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#">
									<div class="twitter-icon"><i class="fa fa-twitter"></i>&nbsp;<span>Share</span></div>
								</a></li>
								<li class="facebook"><a onclick="window.open('http://www.facebook.com/sharer/sharer.php?u={{baseUrl}}{{contentdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="fb-icon"><i class="fa fa-facebook"></i>&nbsp;<span>Share</span></div></a></li>
								<li class="google"><a onclick="window.open('https://plus.google.com/share?url={{baseUrl}}{{contentdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="google-icon"><i class="fa fa-google-plus"></i>&nbsp;<span>Share</span></div></a></li>
							</ul><div class="clearfix"></div>
						</div>


						<div class="share sharewithborder">
							{% if(contentdetail['tags'] | length > 0) %}
								<div class="work-content">
									<ul class="work-category-wrap tagsblack">
										<?php $populartags =$contentdetail['tags'];?>								
										{% for populartag in populartags %}
											<li class="filter" ><a href="{{baseUrl}}/{{currentCity}}/tag/{{elements.create_slug(populartag)}}" data-ga-cat="Tag Link Click on Content Detail - {{cityshown}}" data-ga-action="{{populartag}} | Content" data-ga-label="tag_content_detail_pos_{{key+1}}">
											{{populartag}}
											</a></li>
										{% endfor  %}
									</ul><div class="clearfix"></div>
								</div><div class="clearfix"></div>
							{% endif %}
						</div>


						{% if(author['url'] is defined AND author['url'] != '') %}
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
						{% endif %}
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function addtowishlistwithlogin(){
	
}
</script>