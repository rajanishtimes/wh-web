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
								{{elements.getimage(baseUrl, images['uri'], '', '', contentdetail['title'], '', '', 'img-detail')}}
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
						<?php if(!empty($contentdetail['tags'])){
						?>
						<p class="tags">Tags</p>
						<h>
						<div class="work-content">
							<ul class="work-category-wrap">
								<?php $populartags =$contentdetail['tags'];?>								
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
								<li><a href=""><i class="fa fa-twitter"></i> Share on twitter</a></li>
								<li><a href=""><i class="fa fa-facebook-official"></i> Share on facebook</a></li>
								<li><a href=""><i class="fa fa-google-plus-square"></i> Share on google+</a></li>
							</ul><div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>