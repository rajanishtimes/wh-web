<?php $this->partial('partials/breadcrumbs', array('breadcrumbs' => $breadcrumbs)); ?>
<div class="section">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-md-12">
				<div class="contentarea">
					<div class="owl-slider-set">
						<ul id="owl-work-detail" class="owl-carousel work-detail">
						<?php if(!empty($eventdetail['images'])){ ?>
							{% for key, images in eventdetail['images'] %}
								<li class="item">
									<a href="{{feeds.makeurl(baseUrl, images['uri'])}}" class="swipebox" title="{{eventdetail['title']}}">
										{{feeds.getimage(baseUrl, images['uri'], 880, 520, eventdetail['title'], '', '', 'img-detail', key+1, 'banner')}} 
									</a>
								</li>
							{% endfor  %}
						<?php } ?>
						</ul>
					</div><div class="clearfix"></div>
					<h1 class="contenttitle text-center">{{eventdetail['title'] | stripslashes}}</h1>
					<div class="eventdetail">
						<div class="time">{{eventdetail['time']['short']}}, {{eventdetail['time']['long']}}</div>
						<div class="venue"><a href="{{baseUrl}}{{eventdetail['venue']['url']}}" data-ga-cat="Venue Link Click on Event Detail - {{cityshown}}" data-ga-action="{{eventdetail['venue']['name']}}" data-ga-label="venue">{{eventdetail['venue']['name']}}, {{eventdetail['venue']['formatted_address']}}</a></div>
					</div>
					<div class="sharesmall">
						<ul class="list-inline text-center">
							<li class="twitter"><a onclick="window.open('https://twitter.com/share?url={{baseUrl}}{{eventdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="twitter-icon"><i class="fa fa-twitter"></i>&nbsp;<span>Share</span></div></a></li>
							<li class="facebook"><a onclick="window.open('http://www.facebook.com/sharer/sharer.php?u={{baseUrl}}{{eventdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="fb-icon"><i class="fa fa-facebook"></i>&nbsp;<span>Share</span></div></a></li>
							<li class="google"><a onclick="window.open('https://plus.google.com/share?url={{baseUrl}}{{eventdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="google-icon"><i class="fa fa-google-plus"></i>&nbsp;<span>Share</span></div></a></li>
						</ul><div class="clearfix"></div>
					</div>
					<hr class="small"> 
					<div class="detail">
						{{eventdetail['description']}}
					</div>
					
					<div class="detail">
						<script class="lockerdome-js-lite" src="//cdn2.lockerdome.com/_js/widget_interest_1_0.js" data-owner="7850612108835329" data-style="text" data-width="fixed-width" data-size="custom-small" data-size_specifics="23" data-box="box-off" data-follow_up="share" data-follow_up_specifics="2"data-custom="bttns-no-border-radius"></script>
					</div>
						
					<div class="share">
						<ul class="list-inline navbar-left">
							<li class="twitter"><a onclick="window.open('https://twitter.com/share?url={{baseUrl}}{{eventdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="twitter-icon"><i class="fa fa-twitter"></i>&nbsp;<span>Share</span></div></a></li>
							<li class="facebook"><a onclick="window.open('http://www.facebook.com/sharer/sharer.php?u={{baseUrl}}{{eventdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="fb-icon"><i class="fa fa-facebook"></i>&nbsp;<span>Share</span></div></a></li>
							<li class="google"><a onclick="window.open('https://plus.google.com/share?url={{baseUrl}}{{eventdetail['url']}}','','width=680,height=480,scrollbars=no,resizable=no,location=no,menubar=no,toolbar=no')" href="#"><div class="google-icon"><i class="fa fa-google-plus"></i>&nbsp;<span>Share</span></div></a></li>
						</ul><div class="clearfix"></div>
					</div>

					<div class="share">
						{% if(eventdetail['tags'] | length > 0) %}
							<div class="work-content">
								<ul class="work-category-wrap tagsblack">
									<?php $populartags =$eventdetail['tags'];?>								
									{% for key, populartag in populartags %}
										<li class="filter" ><a href="{{baseUrl}}/{{currentCity}}/tag/{{elements.create_slug(populartag)}}" data-ga-cat="Tag Link Click on Event Detail - {{cityshown}}" data-ga-action="{{populartag}} | Event" data-ga-label="tag_event_detail_pos_{{key+1}}">
										{{populartag}}
										</a></li>
									{% endfor  %}
								</ul><div class="clearfix"></div>
							</div><div class="clearfix"></div>
						{% endif %}
					</div>

					




				</div>
			</div>
		</div>
	</div>
</div>

<?php $date = explode('-', $eventdetail['time']['short']); $startdate = date('Y-m-d', strtotime($date[0]));
	$desc = strip_tags($eventdetail['description']);
	$description = strlen($desc) > 150 ? substr($desc, 0, 150).'...' : $desc;
?>
<script type="application/ld+json">
{
	"@context": "http://schema.org",
	"@type" : "Event",
	"name" : "{{eventdetail['title']}}",
	"image" : "{{eventdetail['images'][0]['uri']}}",
	"description" : "{{description}}",
	"url" : "{{canonical_url}}",
	"location": {
		"@type" : "Place",
		"name" : "{{eventdetail['venue']['name']}}",
		"address" : "{{eventdetail['venue']['formatted_address']}}",
		"url" : "{{baseUrl}}{{eventdetail['venue']['url']}}"
	},
	"startDate": "{{startdate}}"
}
</script>
