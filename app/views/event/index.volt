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
						<div class="venue"><a href="{{baseUrl}}{{city}}/venue/{{eventdetail['venue']['slug']}}">{{eventdetail['venue']['formatted_address']}}</a></div>
					</div>
					<hr class="small">
					<div class="detail">
						{{eventdetail['description']}}
						
						<?php if(!empty($eventdetail['tags'])){ ?>
						<h3 class="tags">Tags</h3>
						<hr>
						<div class="work-content">
							<ul class="work-category-wrap">
								<?php $populartags = explode(',', $eventdetail['tags']);?>								
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
								<li><a href=""><i class="fa fa-twitter-square"></i> Share on twitter</a></li>
								<li><a href=""><i class="fa fa-facebook-square"></i> Share on facebook</a></li>
								<li><a href=""><i class="fa fa-google-plus-square"></i> Share on google+</a></li>
							</ul><div class="clearfix"></div>
						</div>
					</div>
				
					
				</div>
			</div>
		</div>
	</div>
</div>