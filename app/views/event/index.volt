<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="contentarea">
					<ul id="owl-work-detail" class="owl-carousel work-detail">
					{% for images in eventdetail['images'] %}
						<li class="item">
							<a href="{{images['uri']}}" class="swipebox" title="{{eventdetail['title']}}">
								{{feeds.getimage(baseUrl, images['uri'], '', '', eventdetail['title'], '', '', 'img-detail')}}
							</a>
						</li>
					{% endfor  %}
					</ul><div class="clearfix"></div>
					<h2 class="contenttitle text-center">{{eventdetail['title']}}</h2>
					<div class="eventdetail">
						<div class="time">{{eventdetail['time']['short']}}, {{eventdetail['time']['long']}}</div>
						<div class="venue"><a href="{{baseUrl}}{{city}}/venue/{{eventdetail['venue']['slug']}}">{{eventdetail['venue']['name']}}, {{eventdetail['venue']['formatted_address']}}</a></div>
					</div>
					<hr class="small">
					<div class="detail">
						{{eventdetail['description']}}
						
						{% if(eventdetail['tags'] | length > 0) %}
							<p class="tags">Tags</p>
							<div class="work-content">
								<ul class="work-category-wrap">
									<?php $populartags =$eventdetail['tags'];?>								
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
								<li><a target="_blank" onclick="window.open('https://twitter.com/share?url={{eventdetail['share_url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><i class="fa fa-twitter-square"></i> Share on twitter</a></li>
								<li><a target="_blank" onclick="window.open('http://www.facebook.com/sharer/sharer.php?u={{eventdetail['share_url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><i class="fa fa-facebook-square"></i> Share on facebook</a></li>
								<li><a target="_blank" onclick="window.open('https://plus.google.com/share?url={{eventdetail['share_url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><i class="fa fa-google-plus-square"></i> Share on google+</a></li>
							</ul><div class="clearfix"></div>
						</div>
					</div>
				
					
				</div>
			</div>
		</div>
	</div>
</div>