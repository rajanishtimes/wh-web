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
								<img src="{{images['uri']}}" alt="{{eventdetail['title']}}" class="img-detail">
							</a>
						</li>
					{% endfor  %}
					</ul><div class="clearfix"></div>
					<h2 class="contenttitle text-center">{{eventdetail['title']}}</h2>
					<div class="eventdetail">
						<div class="time">{{eventdetail['time']['short']}}, {{eventdetail['time']['long']}}</div>
						<div class="venue">{{eventdetail['venue']['formatted_address']}}</div>
					</div>
					<hr class="small">
					<div class="detail">
						{{eventdetail['description']}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>