<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="contentarea">
					<div class="owl-slider-set">
						<ul id="owl-work-detail" class="owl-carousel work-detail">
						{% for images in eventdetail['images'] %}
							<li class="item">
								<a href="{{feeds.makeurl(baseUrl, images['uri'])}}" class="swipebox" title="{{eventdetail['title']}}">
									{{feeds.getimage(baseUrl, images['uri'], 1025, 350, eventdetail['title'], '', '', 'img-detail')}}
								</a>
							</li>
						{% endfor  %}
						</ul>
					</div><div class="clearfix"></div>
					<h1 class="contenttitle text-center">{{eventdetail['title']}}</h1>
					<div class="eventdetail">
						<div class="time">{{eventdetail['time']['short']}}, {{eventdetail['time']['long']}}</div>
						<div class="venue"><a href="{{baseUrl}}{{eventdetail['venue']['url']}}">{{eventdetail['venue']['name']}}, {{eventdetail['venue']['formatted_address']}}</a></div>
					</div>
					<hr class="small">
					<div class="detail">
						{{eventdetail['description']}}
						{% if(eventdetail['tags'] | length > 0) %}
							<p class="tags">Tags</p>
							<div class="work-content">
								<ul class="work-category-wrap tagsblack">
									<?php $populartags =$eventdetail['tags'];?>								
									{% for populartag in populartags %}
										<li class="filter" ><a href="{{baseUrl}}/tag/{{elements.create_slug(populartag)}}">
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
							<li><a onclick="window.open('https://twitter.com/share?url={{eventdetail['share_url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><i class="fa fa-twitter-square"></i> <span>Share on twitter</span></a></li>
							<li><a onclick="window.open('http://www.facebook.com/sharer/sharer.php?u={{eventdetail['share_url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><i class="fa fa-facebook-square"></i> <span>Share on facebook</span></a></li>
							<li><a onclick="window.open('https://plus.google.com/share?url={{eventdetail['share_url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><i class="fa fa-google-plus-square"></i> <span>Share on google+</span></a></li>
						</ul><div class="clearfix"></div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>

<?php $date = explode('-', $eventdetail['time']['short']); $startdate = date('Y-m-d', strtotime($date[0])); ?>
<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type" : "Event",
	"name" : "{{eventdetail['title']}}",
	"url" : "{{canonical_url}}",
	"location": {
	"@type" : "Place",
	"name" : "{{eventdetail['venue']['name']}}",
	"address" : "{{eventdetail['venue']['formatted_address']}}"
	},
	"startDate": "{{startdate}}"
}
</script>
