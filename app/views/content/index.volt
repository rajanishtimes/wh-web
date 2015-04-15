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
								<img src="{{images['uri']}}" alt="{{contentdetail['title']}}" class="img-detail">
							</a>
						</li>
					{% endfor  %}
					</ul><div class="clearfix"></div>
					<h2 class="contenttitle text-center">{{contentdetail['title']}}</h2>
					<div class="contentdetail text-center">
						By <a href="{{baseUrl}}author/{{contentdetail['author']['slug']}}">{{contentdetail['author']['name']}}</a>
					</div>
					<hr class="small">
					<div class="detail">
						{{contentdetail['description']}}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>